#!/usr/bin/env bash
chown -R www-data:www-data .
/usr/bin/supervisord -n -c /etc/supervisord.conf