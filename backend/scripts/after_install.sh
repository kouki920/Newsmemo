#!/bin/bash

set -eux

cd ~/Newsmemo/backend
php artisan migrate --force
php artisan config:cache
