<?php
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'spanish');
echo utf8_encode(strftime("%A %#d de %B del %Y"));