#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Provision-script user: `whoami`"

export DEBIAN_FRONTEND=noninteractive

info "Configure resolv.conf"
echo "nameserver 119.29.29.29" | tee /etc/resolv.conf > /dev/null

info "Configure locales"
update-locale LC_ALL="C"
dpkg-reconfigure --frontend noninteractive locales

info "Prepare root password for MySQL"
debconf-set-selections <<< "mysql-community-server mysql-community-server/root-pass password \"''\""
debconf-set-selections <<< "mysql-community-server mysql-community-server/re-root-pass password \"''\""
echo "Done!"

info "Update OS software"
sed -i 's/\/archive.ubuntu.com/\/cn.archive.ubuntu.com/g' /etc/apt/sources.list
sed -i 's/\/security.ubuntu.com/\/cn.archive.ubuntu.com/g' /etc/apt/sources.list
sed -i 's/\/us.archive.ubuntu.com/\/cn.archive.ubuntu.com/g' /etc/apt/sources.list
apt-get update -qq
apt-get upgrade -y -qq

info "Install additional software"
apt-get install -y -qq curl unzip composer
apt-get install -y -qq php-curl php-intl php-mbstring php-mysqlnd php-memcached php-gd php-xml php-fpm
apt-get install -y -qq nginx mysql-server-5.7 memcached beanstalkd supervisor
apt-get install -y -qq php-xdebug

info "Configure MySQL"
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf
mysql -uroot <<< "CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY ''"
mysql -uroot <<< "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%'"
mysql -uroot <<< "DROP USER IF EXISTS 'root'@'localhost'"
mysql -uroot <<< "FLUSH PRIVILEGES"
echo "Done!"

info "Configure PHP-FPM"
sed -i 's/user = www-data/user = ubuntu/g' /etc/php/7.0/fpm/pool.d/www.conf
sed -i 's/group = www-data/group = ubuntu/g' /etc/php/7.0/fpm/pool.d/www.conf
sed -i 's/owner = www-data/owner = ubuntu/g' /etc/php/7.0/fpm/pool.d/www.conf
ln -s -f /vagrant/supports/dev/xdebug.ini /etc/php/7.0/fpm/conf.d/xdebug.ini
echo "Done!"

info "Configure NGINX"
sed -i 's/user www-data/user ubuntu/g' /etc/nginx/nginx.conf
echo "Done!"

info "Enabling site configuration"
mkdir -p /vagrant/runtime/logs
ln -s -f /vagrant/supports/dev/nginx.conf /etc/nginx/sites-enabled/store.conf
echo "Done!"

info "Initailize databases for MySQL"
mysql -uroot <<< "CREATE DATABASE IF NOT EXISTS store_dev"
echo "Done!"
