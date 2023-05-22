<?php 
include './class_mysql.php';
include './config.php';
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'spanish');
header('Content-Type: text/html; charset=UTF8');  
require_once __DIR__. "/vendor/autoload.php";

$tipo = MysqlQuery::RequestPost('Exportar');
$Most = Mysql::consulta("SELECT c.Anydesk,c.id_cliente, c.fecha_creacion, c.nombre_completo, c.email_cliente, c.telefono_celular, c.nombre_usuario, d.nombre,r.Nombre, e.Nombre as Esta FROM cliente c INNER JOIN departamento d ON d.idDepartamento = c.id_departamento INNER JOIN estatus e ON e.idEstatus = c.idEstatus INNER JOIN rol r on c.id_rol = r.idRol WHERE c.id_rol = $tipo ORDER BY c.nombre_completo");


$r = Mysql:: consulta ("SELECT * FROM rol WHERE idRol = $tipo");
$rol = mysqli_fetch_array($r, MYSQLI_ASSOC);
$nombre = $rol['Nombre'];



$html = "";
$html = $html . 
" <div width='100%' height='100%'; style='padding:0; margin:0; border:0;'>
<img style='float:right; padding:0;' src='../img/transp_ALCOMEX.png' width='30%' />
<br>
    <div>
        <h2  style='text-align:center;'>" . $nombre . " </h2>
        <br>
    </div>

<table width='100%' class='table'>
            <thead style=' border :1px solid #000; color : #fff;'>
             <tr>
            <td>Id</td>
            <td>Creado</td>
            <td>Nombre completo</td>
            <td>Usuario</td>
            <td>Email</td>
            <td>Teléfono</td>
            <td>Departamento</td>
            <td>Rol</td>
            <td>Estatus</td>
            <td>Anydesk</td>
             </tr>

            </thead>



            <tbody>
          " ;
                $i=1;
            while($Mostrar= mysqli_fetch_array($Most,MYSQLI_ASSOC)){
            $html = $html . "
            <tr>
            <td>".$i++. "</td>
            <td>".$Mostrar['fecha_creacion']."</td>
            <td>".$Mostrar['nombre_completo']."</td>
            <td>".$Mostrar['nombre_usuario']."</td>
            <td>".$Mostrar['email_cliente']."</td>
            <td>".$Mostrar['telefono_celular']."</td>
            <td>".$Mostrar['nombre']."</td>
            <td>".$Mostrar['Nombre']."</td>
            <td>".$Mostrar['Esta']."</td>
            <td>".$Mostrar['Anydesk']."</td>
            </tr>

";
            }

            $html = $html . "
            
            </tbody>
</table>
 
</div> 

<style>
.table{
   /* border: 1px solid #000;*/
   border-collapse: collapse;
   text-align: center;
   border:1;
   margin: 0 auto;
   /*width:500px;*/
}

hr{
   color:black;    
}
.table thead{
 border :1px solid #000;
 background:blue;
color : #fff;
}
 
.table td{
    border: 1px solid #000;  
    padding: 20px;
    font-size:12px;
    font-family: Arial;
    align-items:center;
    justify-content:center;
    
}
.table tr{
    background: #fff;
   
}
p {

font-size:12px;

} 
 
   
</style>
";

$mpdf= new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>
