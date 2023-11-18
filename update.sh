cd /usr/local/var/www/catharicosa/starship-console
git pull origin main
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
php artisan migrate --force
npm run build
