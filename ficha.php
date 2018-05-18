<?php


$nome = "Rodrigo";
$email = "blogbotecodigital@gmail.com";
$endereco = "Rua do Andradas 9999 nº 12";
$cep = "99999-999";
$cidade = "Urugaiana";
$estado = "RS";
$telefone= "9999-9999";
$observacoes = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse mattis fringilla sagittis. Aliquam eu est dapibus justo commodo dapibus. Etiam aliquet, mauris id gravida suscipit, purus ligula venenatis nisi, eget dignissim elit ipsum a libero. In tristique vestibulum arcu sit amet mattis. Ut aliquet cursus consectetur. Fusce eu lacinia magna. Praesent laoreet sapien at est pulvinar nec facilisis sem mollis. Nulla eget congue tellus. Praesent id velit id sem volutpat condimentum ut at ligula. Phasellus libero leo, ultricies et eleifend et, mollis a metus. Duis adipiscing imperdiet luctus. Vestibulum pulvinar, dolor vel porttitor posuere, nisl est lacinia felis, nec gravida felis risus nec ante. Integer imperdiet, dui vitae pellentesque tempor, magna purus accumsan augue, eget hendrerit risus leo quis augue. Vivamus faucibus est quis ante placerat congue. ";
 
require_once("fpdf/fpdf.php");
 
$pdf= new FPDF("P","pt","A4");
 
 
$pdf->AddPage();
$pdf->Image('./img/logomarca.jpg',29,9,60); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
 
$pdf->SetFont('arial','B',18);
$pdf->Cell(0,5,"Ficha",0,1,'C');
$pdf->Image('./img/logomarca.jpg',508,9,60); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
$pdf->Cell(0,5,"","B",1,'C');
$pdf->Ln(8);
 
 
//nome
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Nome:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(0,20,$nome,0,1,'L');
 
//email
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"E-mail:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$email,0,1,'L');
 
//Endere�o
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Endereço:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$endereco,0,1,'L');
 
//cep
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"CEP:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$cep,0,1,'L');
 
//cidade
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Cidade:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$cidade,0,1,'L');
 
//Estado
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Estado:",0,0,'L');
$pdf->setFont('arial','',12);
$pdf->Cell(70,20,$estado,0,1,'L');
 
$pdf->ln(10);
//Observa��es
$pdf->SetFont('arial','B',12);
$pdf->Cell(70,20,"Observações:",0,1,'L');
$pdf->setFont('arial','',12);
$pdf->MultiCell(0,20,$observacoes,0,'J');
 
ob_start();

$pdf->Output();