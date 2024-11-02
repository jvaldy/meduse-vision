# Utilisez l'image de base officielle de PHP 8.0 avec Apache
FROM php:8.1-apache

# Installer les dépendances pour PHP et les extensions requises
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    libzip-dev \
    libicu-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurer et installer des extensions PHP nécessaires
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Activer le mod_rewrite pour Apache
RUN a2enmod rewrite

# Configurer le document root, utile si vous travaillez avec Symfony
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Mettre à jour le fichier de configuration Apache pour utiliser le nouveau document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Exposer le port 80
EXPOSE 80
