# Используем базовый образ PHP с поддержкой FPM версии 8.2
FROM php:8.2-fpm

# Устанавливаем необходимые пакеты и расширения PHP
RUN apt-get update && apt-get install -y \
      apt-utils \  # Установка утилит для работы с apt
      libpq-dev \  # Установка разработческих файлов для работы с PostgreSQL
      libpng-dev \  # Установка разработческих файлов для работы с PNG изображениями
      libzip-dev \  # Установка разработческих файлов для работы с ZIP архивами
      zip unzip \  # Установка утилит для работы с ZIP архивами
      git && \  # Установка системы контроля версий Git
    docker-php-ext-install \  # Установка расширений PHP
      pdo_mysql \  # Расширение для работы с MySQL
      bcmath \  # Математические функции для произвольной точности в PHP
      gd \  # Библиотека для работы с графикой в PHP
      zip && \  # Установка расширения для работы с ZIP архивами в PHP
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*  # Очистка кеша и временных файлов

# Установка Node.js (последняя LTS версия) и npm
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && apt-get install -y nodejs

# Копируем кастомный php.ini для настройки PHP
COPY ./_docker/app/php.ini /usr/local/etc/php/conf.d/php.ini

# Устанавливаем Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

# Устанавливаем директорию работы для контейнера
WORKDIR /var/www
