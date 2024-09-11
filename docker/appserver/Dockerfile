FROM nimmis/apache

MAINTAINER dredix84 <dredix84@gmail.com>

# disable interactive functions
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get install -y software-properties-common
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php

RUN apt-get upgrade -y && apt-get update -y

#Needed for PDF conversion
#RUN apt-get install -y poppler-utils pdf2htmlex unoconv

RUN apt-get install --fix-missing -y php7.1 libapache2-mod-php7.1 php7.1-dom \
php7.1-fpm php7.1-cli php7.1-mysqlnd php7.1-pgsql php7.1-sqlite3 php7.1-redis php7.1-mbstring \
php7.1-apcu php7.1-intl php7.1-imagick php7.1-mcrypt php7.1-json php7.1-gd php7.1-curl php7.1-zip php7.1-memcached \
php7.1-xdebug && \
phpenmod mcrypt && \
phpenmod memcached

RUN apt-get install -y php-pear

RUN apt-get update && apt-get install php7.1-dev -y

#Installing MongoDB
#RUN apt-get install -y php7.1-mongodb && \
#    phpenmod mongodb

# Setup PHP XDebug
#RUN echo "zend_extension=$(find /usr/lib/php/ -name xdebug.so | sort -rn  | head -n 1)" > /etc/php/7.1/fpm/conf.d/20-xdebug.ini
RUN echo "[xdebug]" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.default_enable=1" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_enable=1" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_autostart=1" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_host = 10.0.75.1" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini

# Install networking tools like ping
RUN apt-get install -y iputils-ping


# Setting up PHP SQL driver
# https://docs.microsoft.com/en-us/sql/connect/odbc/linux-mac/installing-the-microsoft-odbc-driver-for-sql-server?view=sql-server-2017
# https://github.com/Microsoft/msphpsql/releases
#RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
#    curl https://packages.microsoft.com/config/ubuntu/16.04/prod.list > /etc/apt/sources.list.d/mssql-release.list
#RUN apt-get install -y apt-transport-https
#RUN apt-get update
#RUN ACCEPT_EULA=Y apt-get install msodbcsql17 -y
#RUN apt-get install unixodbc-dev git -y
#RUN pecl install pdo_sqlsrv
#
## Setup extension for MS SQL Server
#RUN echo "extension=pdo_sqlsrv.so" >> /etc/php/7.1/mods-available/10-sqlsrv.ini \
#    && ln -s /etc/php/7.1/mods-available/10-sqlsrv.ini /etc/php/7.1/cli/conf.d/10-sqlsrv.ini \
#    && ln -s /etc/php/7.1/mods-available/10-sqlsrv.ini /etc/php/7.1/apache2/conf.d/10-sqlsrv.ini \
#    && ln -s /etc/php/7.1/mods-available/10-sqlsrv.ini /etc/php/7.1/fpm/conf.d/10-sqlsrv.ini

# Expose Ports
EXPOSE 80
EXPOSE 443

RUN rm -rf /var/lib/apt/lists/* && \
cd /tmp && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

RUN dpkg -S mod_ssl.so

RUN service apache2 start
RUN a2enmod ssl && a2enmod rewrite
RUN mkdir /etc/apache2/ssl
RUN a2ensite default-ssl

#COPY unoconv.conf /etc/supervisor/conf.d/unoconv.conf
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
WORKDIR /var/www/html
