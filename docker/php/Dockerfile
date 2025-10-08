FROM php:8.3-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libpq-dev libzip-dev libpng-dev libonig-dev curl \
    && docker-php-ext-install intl pdo pdo_mysql zip gd opcache

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer Symfony CLI (utile pour certaines commandes)
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier uniquement les fichiers Composer d'abord pour tirer parti du cache Docker
COPY composer.json composer.lock ./


# Installer les dépendances PHP (sans copier tout le code pour accélérer le cache)
RUN composer install --no-interaction --no-ansi --no-scripts --no-progress --prefer-dist --optimize-autoloader

# Copier le reste du projet Symfony
COPY . .

# Exécuter les scripts post-install (comme cache:clear, assets:install, etc.)
RUN composer dump-autoload --optimize \
    && php bin/console cache:clear --no-warmup || true

# Permissions (si nécessaire)
RUN chown -R www-data:www-data /var/www/html/var

CMD ["php-fpm"]
