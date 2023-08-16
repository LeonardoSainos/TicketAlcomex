echo off
set fecha1=%date%
set fecha2=%date:/=_%
set fecha3=%date:/=%
set hora1=%time%
set hora2=%time::=.%
set hora3=%time::=%
set hora4=%hora3:~0,6%
 
set nombre=%1_%fecha3%_%hora4%.sql
echo %nombre%;

cd C:\xampp\mysql\bin

mysqldump -u root -pSistemas777 %1 > C:\xampp\htdocs\TicketAlcomex\DB\backup\ticketdb\%nombre%

pause > nul

