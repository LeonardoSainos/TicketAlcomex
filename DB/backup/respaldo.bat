echo off
set fecha1= %date%
set fecha2=%date:/=_%
set fecha3=%date:/=%
set hora1= %time%
set hora2=%time::=.%
set hora3=%time::=%

echo %fecha1%
echo %fecha1%
echo %fecha2%
echo %fecha3%
echo %hora1%
echo %hora2%
echo %hora3%
set nombre = respaldo_%fecha3%_%hora3%.sql
echo %nombre%;

cd C:\xampp\mysql\bin

mysqldump -u root ticket > C:\xampp\htdocs\backup\%nombre%

pause > null

