#!/usr/bin/env bash

if [ $# -gt 0 ]; then
    if [ "$1" == "php" ]; then
        shift 1
        docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest php "$@"
    elif [ "$1" == "composer" ]; then
        shift 1
        docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest composer "$@"
    elif [ "$1" == "qa" ]; then
        shift 1
        docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest php ./vendor/bin/pint --preset psr12 --test
        docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest php ./vendor/bin/phpstan analyse
        docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest php ./vendor/bin/phpinsights --no-interaction --min-quality=80 --min-complexity=90 --min-architecture=75 --min-style=95
    elif [ "$1" == "test" ]; then
        shift 1
        docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/var/www/html -w /var/www/html laravelsail/php83-composer:latest php ./vendor/bin/pest "$@"
    elif [ "$1" == "coverage" ]; then
        shift 1
        docker volume create xdebug_config
        docker volume create xdebug_extension
        docker run --rm -v $(pwd):/var/www/html -v xdebug_config:/usr/local/etc/php/conf.d -v xdebug_extension:/usr/local/lib/php/extensions/no-debug-non-zts-20230831 -w /var/www/html laravelsail/php83-composer:latest bash -c "if [ ! -f /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini ] || [ ! -f /usr/local/lib/php/extensions/no-debug-non-zts-20230831/xdebug.so ]; then apt-get update && apt-get install -y libz-dev && pecl channel-update pecl.php.net && pecl install xdebug && echo 'xdebug.mode=coverage' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && docker-php-ext-enable xdebug; fi && ./vendor/bin/pest --coverage --coverage-html reports"
    else
        echo "Unknown command"
    fi
else
    echo "Unknown command"
fi