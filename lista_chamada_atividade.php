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

    $evento_atividade = "SELECT atividades.titulo FROM atividades WHERE idatividades=$id AND atividades.ativo=1;";
    $exe_atividade = mysql_query($evento_atividade) or die(mysql_error());
    $array = mysql_fetch_array($exe_atividade);

//INICIA O PDF
    define('FPDF_FONTPATH', 'fpdf/font/'); # Caminho de onde est� a pasta das fontes
    require ('fpdf/fpdf.php'); # O PDF requer o arquivo abaixo para funcionar
//Neste Classe abaixo eu recrio o cabe�alho e Rodap� por isso extends
//CABE�ALHO E RODAP�          

    class PDF extends FPDF {

        //CABEÇALHO
        function Header() {
            if ($this->PageNo() == 1) {
                $this->Image('img/logomarca.jpg', 75, 5, 60, 30); #logo da empresa
                $this->SetFont('Arial', 'B', 12); #Seta a fonte
                $this->SetTextColor(0, 0, 0); #Seta a cor da fonte padrão RGB
                $this->Ln(22); #Quebra de Linha                    
                $this->Line(20, 45, 199, 45); #Linha na Horizontal
                $this->Ln(4); #Quebra de Linha
                $this->SetFont('Arial', 'B', 14); #Seta a Fonte
                $this->Cell(0, 5, 'Lista de Presença.', 0, 0, 'C', 0); #T�tulo do Relat�rio
                $this->Line(28, 53, 192, 53); #Linha na Horizontal
                $this->Ln(8); #Quebra de Linhas
            }
        }

        //RODAPÉ
        function Footer() {
            $this->AliasNbPages(); #Método de Numerar Páginas
            date_default_timezone_set('America/Sao_Paulo');
            $this->Line(20, 290, 190, 290); #Linha na horizontal
            $this->SetY(290); #Tavo o cursor para escrever no Ponto Y
            $this->SetFont('Arial', 'I', 8); #Seto a Fonte
            $data = strftime('%d/%m/%Y');
            $this->Cell(1, 5, 'Alegre,ES ' . $data, 0, 0, 'C', 0); #Frase de Rodapé
            $this->SetFont('Arial', 'BI', 8); #Seta a Fonte
            $this->Cell(0, 5, 'SISCO Eventos Acadêmicos', 0, 0, 'C', 0); #Frase de Rodapé
            $this->SetFont('Arial', 'I', 8); #Seto a Fonte
            $this->Cell(3, 5, 'Página ' . $this->pageno() . ' de {nb}', 0, 1, 'C', 0); #Imprime o Número das Páginas
        }

    }

    $pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
    $pdf->SetMargins(20, 20, 20); #Seta a Margin Esquerda com 20 mil�metro, superrior com 20 mil�metro e esquerda com 20 mil�metros
    $pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrir� em tamanho PADRÃO e as páginas na exibição ser�o cont�nuas
    $pdf->AddPage(); #Adiciona uma página nova
//CONTEUDO DO PDF
    $pdf->SetFont('Arial', '', '12');
    $query_partic_atividade = "SELECT pessoa.nome, pessoa.email, date_format(atividades.data,'%d/%m/%Y') as data_formatada, atividades.cargahoraria "
            . "FROM participacao "
            . "INNER JOIN pessoa ON pessoa.idpessoa=participacao.Pessoa_idpessoa "
            . "INNER JOIN atividades ON atividades.idatividades=participacao.atividades_idatividades "
            . "INNER JOIN evento ON evento.idevento=participacao.atividades_evento_idevento "
            . "WHERE participacao.atividades_idatividades=$id AND pessoa.ativo=1 AND participacao.presenca=0;";
    $exe_query = mysql_query($query_partic_atividade) or die(mysql_error());
    $num_rows = mysql_num_rows($exe_query);
    $pdf->Ln(3);
    $pdf->SetFont('arial', 'B', 12);
    $pdf->Cell(22, 5, "Atividade: ", 0, 0, 'L');
    $pdf->setFont('arial', '', 12);
    $pdf->Cell(20, 5, utf8_encode($array['titulo']), 0, 1, 'L');
    $pdf->Ln(3);
    $pdf->SetFont('Arial', '', '12');
    $pdf->Cell(0, 4, 'Lista para confirmação de Presença dos Participantes.', 0, 1, 'L',0);
    $pdf->Cell(0, 4, 'Assine a Lista abaixo:', 0, 1, 'L');
    $pdf->SetX(35); #seto a posi��o do cursos no eixo X
    $pdf->SetY(75); #seto a posi��o do cursos no eixo Y                   
//cabeçalho da tabela 
    $pdf->SetFont('arial', 'B', 14);
    $pdf->Cell(60, 10, 'Nome', 1, 0, "C");
    $pdf->Cell(60, 10, 'Email', 1, 0, "C");
    $pdf->Cell(60, 10, 'Assinatura', 1, 0, "C");
    $pdf->Ln();
//linhas da tabela
    $pdf->SetFont('arial', '', 12);
    while ($resultado = mysql_fetch_array($exe_query)) {
        $pdf->Cell(60, 10, $resultado['nome'], 1, 0, "L");
        $pdf->Cell(60, 10, $resultado['email'], 1, 0, "L");
        $pdf->Cell(60, 10, '', 1, 0, "C");
        $pdf->Ln();
    }
    $pdf->Cell(0, 10, 'Número de inscrições no evento: ' . $num_rows, 0, 1, 'R', 0);

    $atividade = utf8_encode($array['titulo']);
    
    ob_end_clean(); #al�m de limpar tamb�m mostra aquilo que foi armazenado no buffer                
    $pdf->Output("Lista_presenca_". $atividade .".pdf","D"); #necess�rio para gerar o PDF. Dentro dos parentes voc� consegue definir se o PDF ser� salvo e o nome com caminho de onde ser� salvo
}            
            /*___________________________________
            Macetes.
            Quando você estiver escrevendo uma classe sempre dever� se reportar aos m�todos com o $this->, quando n�o for dentro da classe usar� o $pdf->.

            $pdf->Cell(0,5,'T�TULO',0,1,'C',0);
            Este Objeto Cell � a mesma coisa que uma caixa de texto. no PDF sempre quando se escreve algo deve ser dentro de uma c�lula

            $pdf-> #Obrigat�rio
            Cell #C�lula
            (0,5, #LARGURA e ALTURA da c�lular - L�rgura 0 significa que ela ser� do tamanho m�ximo da p�gina na horizonta
            'T�TULO', #Texto que ser� exibido
            0,1, #Se a C�lula exibe a borda 0=n�o 1=sim, e o outro n�mero � se depois desta caixa de texto o cursor vai para a pr�xima linha.
            'C',0) #O C � de Centralizado o Texto dentro da C�lula, pode-se usar o L e R. E o 0 do final quer dizer que n�o tem cor de preenchimento.*/
