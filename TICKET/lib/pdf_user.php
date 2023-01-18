<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';


$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT t.fecha,t.serie, e.Nombre as estado_ticket, c.nombre_completo, c.nombre_usuario,c.email_cliente, d.nombre as departamento, t.asunto, t.solucion, t.mensaje FROM ticket t LEFT JOIN cliente c ON t.idUsuario= c.id_cliente INNER JOIN estatus e ON e.idEstatus = t.idStatus INNER JOIN departamento d ON d.idDepartamento= t.idDepartamento WHERE t.serie = '$id';");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

class PDF extends FPDF
{
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(243, 156, 18);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);
$pdf->Image('../img/transp_ALCOMEX.png',20,10,-500);
$pdf->Cell (0,5,utf8_decode('Alcomex'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Reporte de problema mediante Ticket'),0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
 
$pdf->Cell (0,5,utf8_decode('Información de Ticket #'.utf8_decode($reg['serie'])),0,1,'C');
$pdf->Ln();
$pdf->Cell (35,10,'Fecha',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['fecha']),1,1,'L');
$pdf->Cell (35,10,'Serie',1,0,'C',true);
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

$pdf->Ln();

$pdf->cell(0,5,"Alcomex " . date("Y")  ,0,0,'C');

$pdf->output();