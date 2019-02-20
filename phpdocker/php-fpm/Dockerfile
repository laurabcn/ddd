FROM phpdockerio/php72-fpm:latest
WORKDIR "/activities"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php-memcached php7.2-mysql php-redis php-xdebug php-igbinary php7.2-imap php-msgpack php7.2-soap php-ssh2 php7.2-xsl php-yaml \
    && apt-get install php-xml && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

