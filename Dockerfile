# CADViewer Laravel Blade sample - image for Coolify (build pack: Dockerfile) or any Docker host.
# The AutoXchange / DwgMerge / LinkList Linux converters are x86_64 binaries: build for linux/amd64.

FROM php:8.3-apache-bookworm

# xz-utils/unzip: unpack converters and composer dists; font/png libs: AutoXchange runtime
RUN apt-get update \
    && apt-get install -y --no-install-recommends xz-utils unzip libfontconfig1 libfreetype6 libexpat1 libpng16-16 \
    && rm -rf /var/lib/apt/lists/* \
    && a2enmod rewrite headers

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/cadviewer.ini

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-interaction --no-progress

COPY . .

# public/php is the cadviewer-php-scripts submodule: fail early if the checkout skipped it
RUN test -f public/php/call-Api_Conversion.php \
        || { echo "public/php is empty: clone with submodules (git submodule update --init)" >&2; exit 1; } \
    && cp cadviewer/CADViewer_config.php public/php/CADViewer_config.php \
    && composer dump-autoload --no-dev --optimize --no-interaction \
    && cd converters/autoxchange/linux \
    && tar -xJf ax2026_L64_27_06b_163d.tar.xz --strip-components=1 --skip-old-files \
    && rm ax2026_L64_27_06b_163d.tar.xz \
    && chmod +x ax2026_L64_27_06b_163d AxCopy_L64_01_00_02 \
    && cd ../../dwgmerge/linux && gunzip DwgMerge_2023_L64_23_12_03.gz && chmod +x DwgMerge_2023_L64_23_12_03 \
    && cd ../../linklist/linux && gunzip LinkList_2025_L64_25_07_14.gz && chmod +x LinkList_2025_L64_25_07_14

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    QUEUE_CONNECTION=sync

COPY docker/entrypoint.sh /usr/local/bin/cadviewer-entrypoint
RUN chmod +x /usr/local/bin/cadviewer-entrypoint

EXPOSE 80
HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
    CMD curl -fsS -o /dev/null http://localhost/cadviewer || exit 1

ENTRYPOINT ["cadviewer-entrypoint"]
CMD ["apache2-foreground"]
