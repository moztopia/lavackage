#!/bin/bash

##### postCreateCommand.sh
#
# Do you need to do something after your container has been created? Install some 
# ancillary utilities? 
#
# set -eux
# export postCreateCommand=true

##### User Modifiable Options

export NODEJS_INSTALLATION=false
export NODEJS_VERSION=24

export PYTHON_INSTALLATION=false
export PYTHON_VERSION=3.12

export PHP_INSTALLATION=true
export PHP_VERSION=8.3

##### Install OS Package Updates

apt update

##### Install Utilities

echo "Installing System Utilities ..."

apt install -y \
    iputils-ping \
    gawk 

##### Conditional Python3 Installation

if [ "$PYTHON_INSTALLATION" = "true" ]; then
    echo "Installing Python $PYTHON_VERSION ..."

    apt-get update
    apt-get install -y python${PYTHON_VERSION} python${PYTHON_VERSION}-venv python${PYTHON_VERSION}-dev
else
    echo "Python installation skipped."
fi

##### Conditional PHP Installation

if [ "$PHP_INSTALLATION" = "true" ]; then
    echo "Installing PHP $PHP_VERSION and Composer..."

    apt install -y \
        php${PHP_VERSION}-cli \
        php${PHP_VERSION}-xml \
        php${PHP_VERSION}-sqlite3 \
        php${PHP_VERSION}-mysql \
        php${PHP_VERSION}-redis \
        php${PHP_VERSION}-memcached \
        php${PHP_VERSION}-pgsql \
        php${PHP_VERSION}-pdo-pgsql \
        php${PHP_VERSION}-mbstring \
        php${PHP_VERSION}-curl \
        php${PHP_VERSION}-zip \
        php${PHP_VERSION}-bcmath \
        php${PHP_VERSION}-intl \
        php${PHP_VERSION}-tokenizer \
        php${PHP_VERSION}-pdo \
        php${PHP_VERSION}-xdebug \
        php${PHP_VERSION}-gd

    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"
    mv composer.phar /usr/local/bin/composer
else
    echo "PHP installation skipped."
fi

##### Conditional Node.js Installation

if [ "$NODEJS_INSTALLATION" = "true" ]; then
    echo "Installing Node.js $NODEJS_VERSION ..."

    curl -fsSL "https://deb.nodesource.com/setup_${NODEJS_VERSION}.x" | sudo -E bash -
    sudo apt-get install -y nodejs
else
    echo "Node.js installation skipped."
fi

##### Add your changes below here. 
