#!/bin/bash

# Shell provisioner
MODULE_PATH='/vagrant/shell_provisioner/module'
CONFIG_PATH='/vagrant/shell_provisioner/config'

# IP for the vagrant VM
GUEST_IP='10.0.0.200'

#Config
APP_DOMAIN='bookmark_it.local'
APP_DBNAME='bookmark_it'

# Adding an entry here executes the corresponding .sh file in MODULE_PATH
DEPENDENCIES=(
    debian
    tools
    php
    mysql
    apache
    node
    yarn
)

for MODULE in ${DEPENDENCIES[@]}; do
    source ${MODULE_PATH}/${MODULE}.sh
done
