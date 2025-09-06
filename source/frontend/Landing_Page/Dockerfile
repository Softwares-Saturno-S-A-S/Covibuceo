# Usar la imagen oficial de PHP 8.0. con Apache
FROM php:8.0-apache 

# Instalar las extensiones necesarios para usar PDO con MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copiar código fuente de la aplicación al directorio raíz del servidor web
COPY ./source /var/www/html/

# Habilitar los módulos de Apache necesarios, rewrite (reescribir URLs amigables), ssl (Configurar HTTPS) y headers (Manejar cabeceras HTTP)
RUN a2enmod rewrite ssl headers

# Exponer el puerto 80 para el tráfico HTTP. Este comando simplemente documenta que el contenedor escucha en este puerto.
EXPOSE 80