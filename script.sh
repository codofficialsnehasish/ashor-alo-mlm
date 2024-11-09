#!/bin/sh
/usr/bin/php /home/u251289941/domains/ashoralo.in/public_html/artisan queue:work --sleep=5 --tries=3 >> /home/u251289941/domains/ashoralo.in/public_html/storage/logs/worker.log 2>&1

