FROM php:apache

RUN set -x \
    && apt-get update \
    && apt-get install -y libldap2-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install ldap \
    && apt-get purge -y --auto-remove libldap2-dev
RUN a2enmod rewrite
#COPY web /var/www/html
#COPY data_php /usr/local/etc/php/
#RUN apt-get install php7.0-ldap
#RUN service apache2 restart
EXPOSE 80
