FROM php:8.1-apache

COPY . /var/www/html/

# อนุญาตให้เข้าถึงจากทุกที่
RUN echo "<Directory /var/www/html>\nRequire all granted\n</Directory>" >> /etc/apache2/apache2.conf
