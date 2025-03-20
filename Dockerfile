# Use the official PHP image with FPM
FROM php:8.1-fpm

# Install Nginx
RUN apt-get update && apt-get install -y nginx

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www

# Nginx config
COPY nginx.conf /etc/nginx/nginx.conf
COPY your-site.conf /etc/nginx/conf.d/your-site.conf

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM using a supervisor
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
