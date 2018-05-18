
<?php
date_default_timezone_set('America/Sao_Paulo');

//INICIA O PDF
define('FPDF_FONTPATH', 'fpdf/font/'); # Caminho de onde est� a pasta das fontes
require ('fpdf/fpdf.php'); # O PDF requer o arquivo abaixo para funcionar
//Neste Classe abaixo eu recrio o cabe�alho e Rodap� por isso extends
//CABE�ALHO E RODAP�          

class PDF extends FPDF {

    //CABEÇALHO
    function Header() {
        $this->Image('img/logomarca.jpg', 75, 5, 60, 30); #logo da empresa
        $this->SetFont('Arial', 'B', 12); #Seta a fonte
        $this->SetTextColor(0, 0, 0); #Seta a cor da fonte padrão RGB
        $this->Ln(22); #Quebra de Linha                    
        //$this->Line(30, 45, 190, 45); #Linha na Horizontal
        //$this->Ln(4); #Quebra de Linha
        $this->SetFont('Arial', 'B', 14); #Seta a Fonte
        $this->Cell(0, 5, 'Relatório de Usuários Ativos no Sistema', 0, 0, 'C', 0); #Título do Relat�rio
        $this->Line(30, 49, 190, 49); #Linha na Horizontal
        $this->Ln(8);
        $this->Cell(0,5,'Data de emissão: '. date('d/m/Y - H:i:s A'),0,1,'C',0); // INSIRO A DATA CORRENTE NA %d,%m,%Y %h:%i %p');
        $this->Ln(10); #Quebra de Linhas
    }

    //RODAPÉ
    function Footer() {
        $this->AliasNbPages(); #M�todo de Numerar P�ginas
        $this->Line(20, 290, 190, 290); #Linha na horizontal
        $this->SetFont('Arial', 'BI', 8); #Seta a Fonte
        $this->SetY(290); #Tavo o cursor para escrever no Ponto Y
        $this->Cell(130, 5,'SISCO Eventos Acadêmicos', 0, 0, 'C', 0); #Frase de Rodapé
        $this->SetFont('Arial', 'I', 8); #Seto a Fonte
        $this->Cell(40, 5,'Página ' . $this->pageno() . ' de {nb}', 0, 1, 'C', 0); #Imprime o Número das Páginas
    }

}

$pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
$pdf->SetMargins(20, 20, 20); #Seta a Margin Esquerda com 20 mil�metro, superrior com 20 mil�metro e esquerda com 20 mil�metros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrir� em tamanho PADRÃO e as páginas na exibição ser�o cont�nuas
$pdf->AddPage(); #Adiciona uma página nova
//CONTEUDO DO PDF
$pdf->SetFont('Arial', '', '12');
$query_pessoa = "SELECT nome, email, Nome_Instituicao, date_format(data_nasc,'%d/%m/%Y') as datanasc_formatada FROM pessoa WHERE ativo=1;";
$conect = mysql_connect("localhost", "root", "root");
if (!$conect) {
    die("<h1> Falha na conexão com o Banco de Dados!</h1>");
}
$db = mysql_select_db("banco_sisco");
$exe_query = mysql_query($query_pessoa) or die(mysql_error());
$num_rows = mysql_num_rows($exe_query);
$pdf->Ln(5); #Quebra de Linhas
$pdf->Cell(0, 1, "Lista de Usuários que confirmaram cadastro no SISCO Eventos Acadêmicos.", 0, 0, 'L');
//$pdf->Ln(4);
//$pdf->Cell(0, 1, "De acordo com a regra do Evento, para receber o certificado", 0, 0, 'L');
$pdf->Ln(4);
$pdf->Cell(0, 1,'Segue a Lista abaixo:', 0, 1, 'L',0); // tamanho da celula=0(não especifiquei), coloquei um ponto abaixo=1, texto, não sublinhado=0, quebra de linha=1, lado esquerdo=L, sem cor preta a celula=0;
$pdf->SetX(25); #seto a posição do cursos no eixo X
$pdf->SetY(80); #seto a posição do cursos no eixo Y                   
//cabeçalho da tabela 
$pdf->Ln(4);
$pdf->SetFont('arial', 'B', 14);
$pdf->Cell(60, 10, 'Nome', 1, 0, "C");
$pdf->Cell(60, 10, 'Email', 1, 0, "C");
$pdf->Cell(60, 10, 'Instituição', 1, 0, "C");
//$pdf->Cell(60, 10, 'Data de Nascimento', 1, 0, "C");
$pdf->Ln();
//linhas da tabela
$pdf->SetFont('arial', '', 12);
while ($resultado2 = mysql_fetch_array($exe_query)) {
    $pdf->Cell(60, 10, $resultado2['nome'], 1, 0, "L");
    $pdf->Cell(60, 10, $resultado2['email'], 1, 0, "L");
    $pdf->Cell(60, 10, $resultado2['Nome_Instituicao'], 1, 0, "L");
    //$pdf->Cell(60, 10, $resultado2['datanasc_formatada'], 1, 0, "C");
    $pdf->Ln();
}
$pdf->Cell(60, 10, '', 0, 0, "C");
$pdf->Cell(60, 10, '', 0, 0, "C");
$pdf->Cell(60, 10,'número de Cadastros: ' . $num_rows, 0, 0, "C");
ob_end_clean(); #al�m de limpar tamb�m mostra aquilo que foi armazenado no buffer                
$pdf->Output(); #necess�rio para gerar o PDF. Dentro dos parentes voc� consegue definir se o PDF ser� salvo e o nome com caminho de onde ser� salvo

/* ___________________________________
  Macetes.
  Quando você estiver escrevendo uma classe sempre dever� se reportar aos m�todos com o $this->, quando n�o for dentro da classe usar� o $pdf->.

  $pdf->Cell(0,5,'T�TULO',0,1,'C',0);
  Este Objeto Cell � a mesma coisa que uma caixa de texto. no PDF sempre quando se escreve algo deve ser dentro de uma c�lula

  $pdf-> #Obrigat�rio
  Cell #C�lula
  (0,5, #LARGURA e ALTURA da c�lular - L�rgura 0 significa que ela ser� do tamanho m�ximo da p�gina na horizonta
  'T�TULO', #Texto que ser� exibido
  0,1, #Se a C�lula exibe a borda 0=n�o 1=sim, e o outro n�mero � se depois desta caixa de texto o cursor vai para a pr�xima linha.
  'C',0) #O C � de Centralizado o Texto dentro da C�lula, pode-se usar o L e R. E o 0 do final quer dizer que n�o tem cor de preenchimento. */
