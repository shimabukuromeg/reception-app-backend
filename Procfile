// Procfile
release: php artisan migrate:fresh --force
web: vendor/bin/heroku-php-nginx -C nginx_app.conf /public
