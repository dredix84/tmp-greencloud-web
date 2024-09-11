#!/bin/bash

echo "alias cake='/var/www/html/bin/cake'" >> ~/.bashrc

echo "export WEB_SERVER_NAME=${WEB_SERVER_NAME}" >> /etc/apache2/envvars
echo "ServerName localhost" >> /etc/apache2/apache2.conf

service apache2 restart

cd /var/www/html
composer install --no-interaction

php bin/cake.php migrations migrate
php bin/cake.php migrations seed

/my_init
