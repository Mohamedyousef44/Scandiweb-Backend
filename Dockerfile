FROM php:7.2-apache

# Update package lists
RUN apt-get update && apt-get upgrade -y

# Install MySQL client and development libraries
RUN apt-get install mysql-client

# Install PHP extensions for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files into container
COPY . /var/www/html/

# Set the DocumentRoot to the public directory
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/g' /etc/apache2/sites-available/000-default.conf

# Enable mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Install application dependencies using Composer
RUN composer install && composer dump-autoload

# Start MySQL server as a separate process
CMD ["bash", "-c", "service mysql start && apache2-foreground"]