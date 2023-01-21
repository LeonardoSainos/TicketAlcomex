<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';


$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT t.id_atiende, t.fecha,t.serie, e.Nombre as estado_ticket, c.nombre_completo, c.nombre_usuario,c.email_cliente, d.nombre as departamento, t.asunto, t.solucion, t.mensaje FROM ticket t LEFT JOIN cliente c ON t.idUsuario= c.id_cliente INNER JOIN estatus e ON e.idEstatus = t.idStatus INNER JOIN departamento d ON d.idDepartamento= t.idDepartamento WHERE t.serie = '$id';");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);



$atiende = Mysql::consulta("SELECT c.id_cliente, c.nombre_usuario ,c.nombre_completo,c.email_cliente,c.telefono_celular,t.serie FROM cliente c INNER JOIN ticket t ON t.id_atiende = c.id_cliente WHERE t.serie = '$id';");
$reg1 = mysqli_fetch_array($atiende, MYSQLI_ASSOC);


class PDF extends FPDF
{
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,10);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,0); // color de texto
$pdf->SetFillColor(243, 156, 18); // colo de relleno
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);


//$pdf->Cell (0,5,utf8_decode('Alcomex'),0,1,'C');
$pdf->MultiCell (0,5,utf8_decode('Solicitud de soporte 
técnico'),'','C',false);
$pdf->Image('../img/transp_ALCOMEX.png',150,5,50);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln(); 
 
$pdf->Cell (0,5,utf8_decode('Información de Ticket #'.utf8_decode($reg['serie'])),0,1,'C');
$pdf->Ln();
$pdf->Cell (50,12,'Fecha:'.  $reg['fecha'],1,0,'C');
$pdf->Cell (85,24,'SOLICITUD DE SERVICIO TI',1,0,'C');
$pdf->Cell (50,12,'Seguimiento:' . date("Y-m-d h:m:s"),1,1,'L');
$pdf->Cell (50,12,'Creador:'.  $reg['nombre_usuario'],1,0,'L');
$pdf->Cell (85,12,'',0,0,'C');
$pdf->Cell (50,12,'Seguimiento:' . $reg1['nombre_usuario'],1,1,'L');
$pdf->Cell(50, 60, utf8_decode('Área: ' . $reg['departamento']),1,0,'L');
$pdf->Cell(42.5, 60, 'Asunto: ' . $reg['asunto'] ,1,0, 'L');
$pdf->Cell(42.5, 60, 'Fecha de fin: ' . date("y-m-d") ,1,0, 'L');
$pdf->Cell(50, 60, 'Estatus: ' . $reg['estado_ticket'],1,1,'L');
$pdf->Ln(10);
$pdf->Cell(50, 10, utf8_decode('Solución:'),0,1,'L');

$pdf->Cell(185, 60, $reg['solucion'],1,1,'L');

$pdf->Ln(30);

/*$pdf->Cell (35,10,'Serie',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['serie']),1,1,'L');
$pdf->Cell (35,10,'Estado',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['estado_ticket']),1,1,'L');
$pdf->Cell (35,10,'Nombre',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['nombre_usuario']),1,1,'L');
$pdf->Cell (35,10,'Email',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['email_cliente']),1,1,'L');
$pdf->Cell (35,10,'Departamento',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['departamento']),1,1,'L');
$pdf->Cell (35,10,'Asunto',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['asunto']),1,1,'L');
$pdf->Cell (35,15,'Problema',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['mensaje']),1,1,'L');
$pdf->Cell (35,15,'Solucion',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['solucion']),1,1,'L');
*/


//$pdf->cell(0,5,"Alcomex " . date("Y")  ,0,0,'C');

//Update Leonardo Sainos 20-01-2023
$pdf->cell(0,5, "Firma de conformidad: ____________________",0,0,'L');
$pdf->cell(-8,5, utf8_decode("Elaboró: __________________________"),0,0,'R');
$pdf->Ln();
$pdf->cell(0,5, utf8_decode("  (Nombre y firma de operador,usuario ó jefe de área) "),0,0,'L');
$pdf->cell(0,5, utf8_decode("  (Nombre y firma de quien realiza el servicio) "),0,0,'R');
$pdf->output();
$pdf->close();