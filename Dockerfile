FROM php:7.4-cli

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

RUN apt-get update -yqq && \
    apt-get upgrade -yqq && \
    apt-get install -y unzip build-essential git software-properties-common curl pkg-config zip zlib1g-dev

RUN pecl install grpc && pecl install protobuf

RUN echo starting && \
    docker-php-ext-enable grpc && \
    docker-php-ext-enable protobuf

#COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#RUN composer install

CMD ["php", "RefundClient.php"]