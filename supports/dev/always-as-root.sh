#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

info "Clean logs"
cat /dev/null > /vagrant/runtime/logs/app.log
cat /dev/null > /vagrant/runtime/logs/nginx-access.log
cat /dev/null > /vagrant/runtime/logs/nginx-error.log

info "Clean assets"
rm -rf /vagrant/web/assets/*

info "Clean debug"
rm -rf /vagrant/runtime/debug/*

info "Restart web-stack"
service php7.0-fpm restart
service nginx restart
service mysql restart
