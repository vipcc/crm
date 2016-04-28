#!/bin/sh
cd /data/httpd/lisod

i=0

while [ $i -lt 20 ]
do
   /usr/local/bin/php /data/httpd/lisod/cron.php
   sleep 3
   i=`expr $i + 1`
done
