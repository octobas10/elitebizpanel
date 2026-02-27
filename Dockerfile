# EliteBizPanel — Yii 1.x on PHP 8.2 + Apache
FROM php:8.2-apache

# PHP extensions for Yii + MySQL + Redis (Predis is pure PHP)
RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql

# Yii 1.1.29 into /opt/yii (not under document root so volume mount does not overwrite)
RUN apt-get update && apt-get install -y --no-install-recommends curl unzip \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sL https://github.com/yiisoft/yii/archive/refs/tags/1.1.29.tar.gz | tar xz -C /tmp \
    && mv /tmp/yii-1.1.29 /opt/yii \
    && rm -rf /tmp/*

# Document root and serve index.php by default
ENV APACHE_DOCUMENT_ROOT=/var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && echo 'DirectoryIndex index.php index.html' > /etc/apache2/conf-available/directory-index.conf \
    && a2enconf directory-index \
    && a2enmod rewrite

# Ensure protected/runtime and assets are writable by www-data after volume mount
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]

WORKDIR /var/www/html
