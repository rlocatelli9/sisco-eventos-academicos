<?php

if (!isset($_SESSION)) {
    session_start();
}

//$nivel_necessario = 2;
// Verifica se n?o h? a vari?vel da sess?o que identifica o usu?rio
if (!isset($_SESSION['UsuarioNome']) && $_SESSION['UsuarioID']) {
    // Destr?i a sess?o por seguran?a
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: validacao.php");
    exit;
}

$id = (isset($_GET['id']) ? $_GET['id'] : NULL);
if ($id == NULL) {

    echo 'Não deu para pegar o ID.';
    exit();
} else {
    include './conexao.php';

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
            $this->Cell(0, 5, 'Ficha de Comissão de Evento', 0, 0, 'C', 0); #Título do Relat�rio
            $this->Line(30, 49, 180, 49); #Linha na Horizontal
            $this->Ln(8);
            $this->Cell(0, 5, 'Data de emissão: ' . date('d/m/Y - H:i:s A'), 0, 1, 'C', 0); // INSIRO A DATA CORRENTE NA %d,%m,%Y %h:%i %p');
            $this->Ln(5); #Quebra de Linhas
        }

        //RODAPÉ
        function Footer() {
            $this->AliasNbPages(); #M�todo de Numerar P�ginas
            $this->Line(20, 290, 190, 290); #Linha na horizontal
            $this->SetFont('Arial', 'BI', 8); #Seta a Fonte
            $this->SetY(290); #Tavo o cursor para escrever no Ponto Y
            $this->Cell(130, 5, 'SISCO Eventos Acadêmicos', 0, 0, 'C', 0); #Frase de Rodapé
            $this->SetFont('Arial', 'I', 8); #Seto a Fonte
            $this->Cell(40, 5, 'Página ' . $this->pageno() . ' de {nb}', 0, 1, 'C', 0); #Imprime o Número das Páginas
        }

    }

    $pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
    $pdf->SetMargins(20, 20, 20); #Seta a Margin Esquerda com 20 mil�metro, superrior com 20 mil�metro e esquerda com 20 mil�metros
    $pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrir� em tamanho PADRÃO e as páginas na exibição ser�o cont�nuas
    $pdf->AddPage(); #Adiciona uma página nova
//CONTEUDO DO PDF
    $pdf->SetFont('Arial', '', '12');
    $query_pessoa = "SELECT comissao.idcomissao, comissao.portaria, funcao_comissao.descricao_comissao, pessoa.nome, pessoa.email, evento.titulo, evento.descricao FROM comissao "
            . "INNER JOIN funcao_comissao ON funcao_comissao.idfuncao_comissao=comissao.funcao_comissao_idfuncao_comissao "
            . "INNER JOIN pessoa ON pessoa.idpessoa=comissao.Pessoa_idpessoa "
            . "INNER JOIN evento ON evento.idevento=comissao.evento_idevento "
            . "WHERE evento.ativo=1 AND funcao_comissao.idfuncao_comissao=$id;";
    $conect = mysql_connect("localhost", "root", "root");
    if (!$conect) {
        die("<h1> Falha na conexão com o Banco de Dados!</h1>");
    }
    $db = mysql_select_db("banco_sisco");
    $exe_query = mysql_query($query_pessoa) or die(mysql_error());
    $num_rows = mysql_num_rows($exe_query);
   
    $pdf->SetX(25); #seto a posição do cursos no eixo X
    $pdf->SetY(60); #seto a posição do cursos no eixo Y                   
//cabeçalho da tabela 
    //$pdf->Ln(4);
    $pdf->SetFont('arial', 'B', 12);
    if ($id == 1) {
        $pdf->Cell(0, 5, "COMISSÃO ORGANIZADORA", 0, 1, 'C');
    }
    if ($id == 2) {
        $pdf->Cell(0, 5, "COMISSÃO CIENTÍFICA", 0, 1, 'C');
    }
    if ($id == 3) {
        $pdf->Cell(0, 5, "COMISSÃO DE APOIO", 0, 1, 'C');
    }
        $pdf->Cell(0, 1, "", 0, 1, 'C',1);
    //$i = 0;
    while ($resultado2 = mysql_fetch_array($exe_query)) {
        //nome
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(90, 5, "Portaria:", 0, 0, 'R', 0);
        $pdf->setFont('arial', '', 12);
        $pdf->Cell(0, 5, $resultado2['portaria'], 0, 1, 'L',0);

//email
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(90, 5, "Evento:", 0, 0, 'R', 0);
        $pdf->setFont('arial', '', 12);
        $pdf->Cell(0, 5, $resultado2['titulo'], 0, 1, 'L',0);

//Endere�o
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(90, 5, "Nome:", 0, 0, 'R');
        $pdf->setFont('arial', '', 12);
        $pdf->Cell(0, 5, $resultado2['nome'], 0, 1, 'L');

//cep
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(90, 5, "Email:", 0, 0, 'R');
        $pdf->setFont('arial', '', 12);
        $pdf->Cell(0, 5, $resultado2['email'], 0, 1, 'L', 0);
        $pdf->Cell(0, 5,'', 0, 1, 'L', 0);
        

//        $pdf->ln(10);
////Observa��es
//        $pdf->SetFont('arial', 'B', 12);
//        $pdf->Cell(30, 5, "Observações:", 0, 1, 'L', 0);
//        $pdf->setFont('arial', '', 12);
//        $pdf->MultiCell(0, 20, $resultado2['descricao'], 0, 'J');

    }
    $pdf->Cell(0, 1, "", 0, 1, 'C',1);


    ob_end_clean(); #al�m de limpar tamb�m mostra aquilo que foi armazenado no buffer                
    $pdf->Output("comissao.pdf","D"); #necess�rio para gerar o PDF. Dentro dos parentes voc� consegue definir se o PDF ser� salvo e o nome com caminho de onde ser� salvo

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
}