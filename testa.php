<?php
require_once("fpdf/fpdf.php");
define ('FPDF_FONTPATH','fpdf/font/'); # Caminho de onde está a pasta das fontes
$pdf=new FPDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetXY(10, 20);
$pdf->SetFont('Helvetica', 'B', 14);
$pdf->Cell(65, 5, 'Testando a biblioteca FPDF');
$pdf->SetFont('Helvetica', 'I', 14);
$pdf->Cell(0, 5, '(http://www.fpdf.org)');
$pdf->ln(); // pula 1 linha
$pdf->SetLineWidth(0.5);
$pdf->Line(10, 27, 200, 27);
$pdf->ln();
$pdf->SetFont('Courier', '', 10);
$pdf->SetLineWidth(0.5);
$pdf->MultiCell(0, 5, "Com essa biblioteca voce pode criar arquivos .PDF com facilidade permitindo dar um acabamento melhor aos seus trabalhos\nAssim você poderá ter um controle muito bom sobre a saída em texto dos seus programas.\nComo por exemplo colocar uma borda em torno dos seus textos.\nOu traçar uma linha como a que está logo acima.", 1, 0);
$pdf->ln(2);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(0, 5, 'Poderá variar fontes:', 0, 1);
$pdf->SetFont('Courier', '', 10);
$pdf->Cell(0, 5, 'Texto em Courier 10 padrão:', 0, 1);
$pdf->SetFont('Courier', 'B', 12);
$pdf->Cell(0, 5, 'Texto em Courier 12 negritado:', 0, 1);
$pdf->SetFont('Courier', 'BI', 14);
$pdf->Cell(0, 5, 'Texto em Courier 14 negritado e itálico:', 0, 1);
$pdf->ln(2);
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(0, 5, 'Texto em Helvetica 10 padrão:', 0, 1);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(0, 5, 'Texto em Helvetica 12 negritado:', 0, 1);
$pdf->SetFont('Helvetica', 'BI', 14);
$pdf->Cell(0, 5, 'Texto em Helvetica 14 negritado e itálico:', 0, 1);
$pdf->ln();
$pdf->SetFont('Helvetica', '', 10);
$pdf->Cell(0, 5, 'Poderá trabalhar com alinhamentos:', 0, 1);
$pdf->Cell(0, 5, 'Alinhamento centralizado', 1, 1, 'C');
$pdf->Cell(0, 5, 'Alinhamento à esquerda', 1, 1, 'L');
$pdf->Cell(0, 5, 'Alinhamento à direita', 1, 1, 'R');
$pdf->MultiCell(60, 5, 'Ou até mesmo poderá trabalhar com alinhamento justificado.', 1,'J',0,1);
$pdf->ln();
$pdf->Cell(70, 5, "Trabalhando com cores em RGB", 0, 0);
$pdf->SetTextColor(0, 0, 256);
$pdf->Cell(30, 5, "Azul", 0, 0);
$pdf->SetTextColor(0, 256, 0);
$pdf->Cell(30, 5, "Verde", 0, 0);
$pdf->SetTextColor(256, 0, 0);
$pdf->Cell(30, 5, "Vermelho", 0, 0);
$pdf->SetTextColor(256, 256, 0);
$pdf->Cell(30, 5, "Amarelo", 0, 1);
$pdf->ln(3);
$pdf->SetFillColor(200);
$pdf->SetTextColor(30, 30, 30);
//(largura da tabela, altura da tabela, campo de escrita, borda da tabela, posicao do texto(esquerda, centralizado, direita),
$pdf->MultiCell(0, 5, "E para terminar esse capítulo colocamos esse texto em sombreado para você poder avaliar alguns dos recursos do FPDF.No próximo capítulo explicarei como expandir a classe para gerar relatórios .", 1, 'C', 1, 1);
$pdf->Output();
?>
