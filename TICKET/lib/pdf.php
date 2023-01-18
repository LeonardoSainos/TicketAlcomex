<?php
require "./fpdf/fpdf.php";
include './class_mysql.php';
include './config.php';

$id = MysqlQuery::RequestGet('id');
$sql = Mysql::consulta("SELECT t.id, t.fecha, t.serie, t.asunto, t.mensaje, t.solucion, c.nombre_completo , c.email_cliente, d.nombre as departamento, e.Nombre  FROM ticket t INNER JOIN cliente c ON t.idUsuario = c.id_cliente INNER JOIN departamento d ON d.idDepartamento = t.idDepartamento INNER JOIN estatus e ON t.idStatus = e.idEstatus  WHERE t.id= $id");
$reg = mysqli_fetch_array($sql, MYSQLI_ASSOC);

class PDF extends FPDF
{
}

$pdf=new PDF('P','mm','Letter');
$pdf->SetMargins(15,20);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(243, 115, 8 );
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont("Arial","b",9);
$pdf->Image('../img/Transp_ALCOMEX.png',10,10,-400);

$pdf->Cell (0,5,utf8_decode('Alcomex'),0,1,'C');
$pdf->Cell (0,5,utf8_decode('Reporte de problema mediante Ticket'),0,1,'C');

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell (0,5,utf8_decode('Información de Ticket '. $reg['serie']),0,1,'C');

$pdf->Cell (35,10,'Fecha',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['fecha']),1,1,'L');
$pdf->Cell (35,10,'Serie',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['serie']),1,1,'L');
$pdf->Cell (35,10,'Estado',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['Nombre']),1,1,'L');
$pdf->Cell (35,10,'Nombre',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['nombre_completo']),1,1,'L');
$pdf->Cell (35,10,'Email',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['email_cliente']),1,1,'L');
$pdf->Cell (35,10,'Departamento',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['departamento']),1,1,'L');
$pdf->Cell (35,10,'Asunto',1,0,'C',true);
$pdf->Cell (0,10,utf8_decode($reg['asunto']),1,1,'L');
$pdf->Cell (35,15,'Problema',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['mensaje']),1,1,'L');
$pdf->Cell (35,15,'Solución',1,0,'C',true);
$pdf->Cell (0,15,utf8_decode($reg['solucion']),1,1,'L');

$pdf->Ln();

$pdf->cell(0,5,"Alcomex " . date("Y"),0,0,'C');

$pdf->output();