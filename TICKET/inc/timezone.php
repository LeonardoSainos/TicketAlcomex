<?php
date_default_timezone_set('America/Mazatlan');
setlocale(LC_TIME, 'spanish');
echo utf8_encode(strftime("%A %#d de %B del %Y"));
?>