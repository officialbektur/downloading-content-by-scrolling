# _docker/cicd/app/Dockerfile

# Используем базовый образ PHP с поддержкой FPM
FROM php:8.2-fpm

# Устанавливаем необходимые пакеты и расширения PHP
# Установка базовых утилит apt
# Установка разработочных файлов для PostgreSQL
# Установка разработочных файлов для библиотеки libzip
# Установка утилит для работы с zip архивами
# Установка системы контроля версий Git
# Установка PHP расширений
# Расширение для работы с MySQL
# Математические функции произвольной точности
# Библиотека для работы с изображениями
# Работа с zip архивами в PHP
# Очистка временных файлов
RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Устанавливаем Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

# Устанавливаем Node.js и npm (последняя LTS версия)
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && apt-get install -y nodejs

# Копируем кастомный php.ini для настройки PHP
COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Устанавливаем директорию работы
WORKDIR /var/www

# Копируем файлы Composer и устанавливаем зависимости
COPY composer.* ./
RUN composer install --no-interaction --no-plugins --no-scripts --no-autoloader --prefer-dist

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

# Создаем автозагрузку Composer
RUN composer dump-autoload --no-scripts --optimize

# Устанавливаем зависимости npm и собираем ассеты
RUN npm install && npm run build
