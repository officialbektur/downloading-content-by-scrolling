# Используем базовый образ PHP с поддержкой FPM версии 8.2
FROM php:8.2-fpm

# Устанавливаем необходимые пакеты и расширения PHP
# Установка утилит для работы с apt
# Установка разработческих файлов для работы с PostgreSQL
# Установка разработческих файлов для работы с PNG изображениями
# Установка разработческих файлов для работы с ZIP архивами
# Установка утилит для работы с ZIP архивами
# Установка системы контроля версий Git
# Установка расширений PHP
# Расширение для работы с MySQL
# Математические функции для произвольной точности в PHP
# Библиотека для работы с графикой в PHP
# Установка расширения для работы с ZIP архивами в PHP
# Очистка кеша и временных файлов
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
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \

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
