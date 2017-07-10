#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

function append {
  if [ -f $1 ]; then
    grep -q "$2" $1 || echo "$3" >> $1
  else
    echo "$3" > $1
  fi
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Set dev env & Automatically move into the /vagrant folder"
append /home/ubuntu/.profile 'export YII_ENV' 'export YII_ENV=dev'$'\ncd /vagrant'

info "Disable xdebug when composer run"
append /home/ubuntu/.bash_aliases 'function composer()' 'function composer() { COMPOSER="$(which composer)" || { echo "Could not find composer in path" >&2 ; return 1 ; } && sudo phpdismod -s cli xdebug ; $COMPOSER "$@" ; STATUS=$? ; sudo phpenmod -s cli xdebug ; return $STATUS ; }'
. ~/.bash_aliases

info "Install project dependencies"
cd /vagrant
composer install --no-progress --prefer-dist

info "Apply migrations"
YII_ENV=dev php yii migrate/up --interactive=0

info "Enabling colorized prompt for guest console"
sed -i "s/#force_color_prompt=yes/force_color_prompt=yes/" /home/ubuntu/.bashrc
