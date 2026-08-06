FROM dunglas/frankenphp:latest-alpine

# Pasang ekstensi PHP yang dibutuhkan oleh WordPress
RUN install-php-extensions mysqli gd intl zip opcache bcmath exif

# Salin source code WordPress ke direktori default /app
COPY . /app

# Atur permission
RUN chown -R www-data:www-data /app


