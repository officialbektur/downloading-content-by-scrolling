# _docker/cicd/app/Dockerfile

# Используем базовый образ PHP с поддержкой FPM
FROM php:8.2-fpm

# Устанавливаем необходимые пакеты и расширения PHP
RUN apt-get update && apt-get install -y \
      apt-utils \                 # Установка базовых утилит apt
      libpq-dev \                 # Установка разработочных файлов для PostgreSQL
      libpng-dev \                # Установка разработочных файлов для библиотеки libpng
      libzip-dev \                # Установка разработочных файлов для библиотеки libzip
      zip unzip \                 # Установка утилит для работы с zip архивами
      git && \                    # Установка системы контроля версий Git
    docker-php-ext-install \      # Установка PHP расширений
      pdo_mysql \                # Расширение для работы с MySQL
      bcmath \                   # Математические функции произвольной точности
      gd \                       # Библиотека для работы с изображениями
      zip && \                   # Работа с zip архивами в PHP
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*   # Очистка временных файлов

# Устанавливаем Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

# Устанавливаем Node.js и npm (последняя LTS версия)
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash - && apt-get install -y nodejs

# Настраиваем PHP
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
RUN npm install && npm run production

# Удаляем лишние пакеты
RUN apt-get purge -y --auto-remove \
      apt-utils \                 # Удаление базовых утилит apt
      libpq-dev \                 # Удаление разработочных файлов для PostgreSQL
      libpng-dev \                # Удаление разработочных файлов для библиотеки libpng
      libzip-dev \                # Удаление разработочных файлов для библиотеки libzip
      zip unzip \                 # Удаление утилит для работы с zip архивами
      git                         # Удаление системы контроля версий Git

# Очищаем кеш и временные файлы
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
