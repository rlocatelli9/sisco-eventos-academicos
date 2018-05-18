<?php
define('FPDF_FONTPATH','fpdf/font/');
require('fpdf/fpdf.php');
$pdf=new FPDF('P','cm','A4');
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','','12');
$sql="SELECT * FROM participante;";
$sql2="SELECT idevento, nome FROM evento where idevento=2;";
$conect = mysql_connect("localhost","root","root");
if(!$conect) die ("<h1> Falha na conexão com o Banco de Dados!</h1>");
$db = mysql_select_db("projeto");
$execute_query = mysql_query($sql) or die (mysql_error());
$exe_query = mysql_query($sql2) or die (mysql_error());
$resultado2=mysql_fetch_array($exe_query);

   $pdf->Cell(0,1,"Lista para confirmação de Presença dos Participantes do Evento.",0,1,'L');

   $pdf->Cell(0,1,"De acordo com a regra do Evento, para receber o certificado",0,1,'L');
   $pdf->Cell(0,1,"é preciso estar presente em 75% das presença no evento. Segue a Lista abaixo:",0,1,'L');
   $pdf->Cell(2.5,1," EVENTO: ",0,0,'L');
   $pdf->Cell(0,1,$resultado2['nome'],0,1,'L');
   
   $pdf->Cell(5,1,"NOME",0,0,'C');
   $pdf->Cell(5,1,"EMAIL",0,0,'C');
   $pdf->Cell(5,1,"ASSINATURA",0,1,'C');

while($resultado=mysql_fetch_array($execute_query))
{

   $pdf->Cell(5,0.8,$resultado['nome'],1,0,'L');
   $pdf->Cell(5,0.8,$resultado['email'],1,0,'L');
   $pdf->Cell(5,0.8,"",1,1,'L');
}

$pdf->Output("lista_chamada.pdf","D");
?>
