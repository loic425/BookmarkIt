#!/bin/bash

cd /var/www/bookmark_it

composer install --no-progress -n

sed -i "s/DATABASE_URL=*/DATABASE_URL=mysql:\/\/root:vagrant@bookmark_it.local\/bookmark_it_%kernel.environment%/g" .env

php bin/console app:install --no-interaction
php bin/console sylius:fixtures:load --no-interaction
yarn install
yarn run gulp
