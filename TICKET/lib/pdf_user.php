<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';
date_default_timezone_set('America/Mexico_City');
setlocale(LC_TIME, 'spanish');
//require '../inc/timezone.php';
header('Content-Type: text/html; charset=UTF8');  
require_once __DIR__. "/vendor/autoload.php";

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT t.id_atiende, t.fecha,t.serie,t.fecha_actualizacion, e.Nombre as estado_ticket, c.nombre_completo, c.nombre_usuario,c.email_cliente, d.nombre as departamento, t.asunto, t.solucion, t.mensaje,t.fecha_actualizacion as actualizacion FROM ticket t LEFT JOIN cliente c ON t.idUsuario= c.id_cliente INNER JOIN estatus e ON e.idEstatus = t.idStatus INNER JOIN departamento d ON d.idDepartamento= t.idDepartamento WHERE t.serie = '$id';");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);



$atiende = Mysql::consulta("SELECT c.id_cliente, c.nombre_usuario ,c.nombre_completo,c.email_cliente,c.telefono_celular,t.serie FROM cliente c INNER JOIN ticket t ON t.id_atiende = c.id_cliente WHERE t.serie = '$id';");
$reg1 = mysqli_fetch_array($atiende, MYSQLI_ASSOC);


$html = "";

$html = $html . 
" <div width='100%' height='100%'; style='padding:0; margin:0; border:0;'>

<img style='float:right; padding:0;' src='../img/transp_ALCOMEX.png' width='30%' />
<br>
    <div>
        <h2  style='text-align:center;'>Solicitud de soporte técnico </h2>
        <br>
        <h4>Información de Ticket # ".$reg['serie']."</h4>
    </div>

<table width='100%' class='table'>
            <thead style=' border :1px solid #000; color : #fff;'>
                <tr colspan='4'>
                    <td><strong>Creado :</strong>" . $reg['fecha']. "</td>
                    <td colspan='2' rowspan='2'><h3>Solicitud de servicio TI</h3></td>
                    <td><strong>Actualizado:</strong>" . $reg['fecha_actualizacion']." </td>
                </tr>
                <tr colspan='3'>
                    <td><strong>Creador:</strong>" . $reg['nombre_completo'] . " </td>
                    <td><strong>Seguimiento:</strong>" . $reg1['nombre_completo'] . "</td>
                </tr>
                <tr colspan='4' rowspan='1'>
                    <td > <strong>Departamento: </strong>".$reg['departamento']."</td>
                    <td ><strong>Asunto :</strong>".$reg['asunto']."</td>
                    <td ><strong>Fecha de cierre:</strong>". $reg['fecha_actualizacion'] ."</td>
                    <td ><strong>Estatus:</strong> ". $reg['estado_ticket']. "</td>
                </tr>

                
                <tr colspan='4'>
                    <td  colspan='2' style='text-align: left;'   ><strong>Foto:</strong><br><br><img src='../user/". $reg['foto'] . "' width=100px height='auto' alt='foto ticket'/> </td>
                    <td colspan='2' ><strong>Solución:</strong> " . $reg['solucion']." </td>
                
                    </tr>

               
                  


            </thead>
</table>


<br><br><br><br><br><br><br><br><br><br><br><br> 


<p><strong>Firma de conformidad: ____________________  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;          Elaboró: __________________________</strong></p>
<p><strong>(Nombre y firma de usuario) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                (Nombre y firma de quien realiza el servicio)</strong></p>

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
