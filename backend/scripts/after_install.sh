#!/bin/bash

set -eux

cd ~/backend
php artisan migrate --force
php artisan config:cache
