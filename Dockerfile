FROM php:8.0-apache

# Instalar la extensión mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Cambiar el puerto de Apache a 8080
RUN sed -i 's/80/8080/g' /etc/apache2/ports.conf && \
    sed -i 's/:80/:8080/g' /etc/apache2/sites-available/000-default.conf

# Reiniciar Apache
CMD ["apache2ctl", "-D", "FOREGROUND"]