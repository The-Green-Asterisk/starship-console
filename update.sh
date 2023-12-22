cd /usr/local/var/www/catharicosa/starship-console
git pull origin main
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
php artisan migrate --force
npm run prod
php artisan cache:clear
php artisan route:cache