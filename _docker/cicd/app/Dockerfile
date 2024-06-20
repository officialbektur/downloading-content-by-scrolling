# _docker/cicd/app/Dockerfile
# _docker/cicd/app/Dockerfile

FROM php:8.2-fpm

# Установка необходимых пакетов
RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install \
      pdo_mysql \
      bcmath \
      gd \
      zip && \
      apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Установка Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

# Установка Node.js и npm (последняя LTS версия)
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && apt-get install -y nodejs

# Настройки PHP
COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /var/www

# Копирование файлов Composer и установка зависимостей
COPY composer.* ./
RUN composer install --no-interaction --no-plugins --no-suggest --no-scripts --no-autoloader --prefer-dist

# Копирование всех файлов проекта
COPY app            /var/www/app
COPY bootstrap      /var/www/bootstrap
COPY config         /var/www/config
COPY database       /var/www/database
COPY public         /var/www/public
COPY resources      /var/www/resources
COPY routes         /var/www/routes
COPY storage        /var/www/storage
COPY artisan        /var/www/artisan
COPY package.json   /var/www/package.json
COPY postcss.config.js /var/www/postcss.config.js
COPY tailwind.config.js /var/www/tailwind.config.js
COPY vite.config.js /var/www/vite.config.js

# Создание автозагрузки Composer
RUN composer dump-autoload --no-scripts --optimize

# Установка npm-зависимостей и сборка ассетов
RUN npm install && npm run build

# Создание алиаса для artisan
RUN echo "alias a='artisan'" >> /root/.bashrc
