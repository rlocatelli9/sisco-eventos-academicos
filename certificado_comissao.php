<?php

if (!isset($_SESSION)) {
    session_start();
}
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
#Possibilita a correta operação no IE
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename=arquivo.pdf');
//INICIA O PDF
    define('FPDF_FONTPATH', 'fpdf/font/'); # Caminho de onde está a pasta das fontes
    require ('fpdf/fpdf.php'); # O PDF requer o arquivo abaixo para funcionar
    require ("conexao.php"); // A MINHA CONEX�O FICOU EM CONFIG.PHP
//Neste Classe abaixo eu recrio o cabe�alho e Rodap� por isso extends
//CABEÇALHO E RODAPÉ

    class PDF extends FPDF {

        //CABE�ALHO
        function Header() {
            //endereco da imagem,posicao X(horizontal),posicao Y(vertical), tamanho altura, tamanho largura
            $this->Image("img/certificado ifes.jpg", 0, 0, 290, 210);
            $this->SetFont('Times', 'B', 45); #Seta a fonte
            $this->SetTextColor(0, 0, 0); #Seta a cor da fonte padr�o RGB
            $this->Ln(30); #Quebra de Linha
            $this->SetX(38); #Tavro o cursor para escrever no Ponto X
            $this->Cell(0, 5, 'CERTIFICADO', 0, 1, 'C', 0); #t�tulo do m�dulo do sistema
            $this->Ln(10); #Quebra de Linhas
        }

        //RODAPÉ
        function Footer() {
            $this->AliasNbPages(); #Método de Numerar P�ginas
            $this->SetY(195); #Travo o cursor para escrever no Ponto Y
            $this->SetFont('Arial', 'I', 8); #Seto a Fonte
            $this->Cell(270, 5, 'Certificado emitido digitalmente. Código: ' . $this->PageNo() . $_SESSION['UsuarioID'] . '0001SISCO', 0, 1, 'R', 0); #Imprime o N�mero das P�ginas
            $this->Cell(270, 5, 'Acesse: 127.0.0.1/sisco/certificado e verfique a veracidade do mesmo.', 0, 1, 'R', 0); #Imprime o N�mero das P�ginas
            $this->Line(200, 200, 289, 200); #Linha na horizontal.
        }

    }

    $pdf = new PDF('L', 'mm', 'A4'); #Crio o PDF padrão PAISAGEM, Medida em Milímetro e papel A4
    $pdf->SetMargins(20, 20, 20); #Seta a Margin Esquerda com 20 milímetro, superior com 20 milímetro e esquerda com 20 milímetros
    $pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas
//CONTEUDO DO PDF
    $pdf->SetFont('Arial', '', 14); #Seto a Fonte
    $sql = mysql_query("SELECT comissao.idcomissao, pessoa.idpessoa, pessoa.nome, funcao_comissao.descricao_comissao, "
            ."evento.idevento, evento.titulo as titulo_evento, evento.periodoon as comeca, evento.periodooff as termina, evento.cargahoraria FROM comissao "
	    ."INNER JOIN funcao_comissao ON funcao_comissao.idfuncao_comissao=comissao.funcao_comissao_idfuncao_comissao "
            ."INNER JOIN pessoa ON pessoa.idpessoa= comissao.Pessoa_idpessoa "
            ."INNER JOIN evento ON evento.idevento = comissao.evento_idevento "
            ."WHERE idpessoa=$id AND pessoa.ativo=1 AND funcao_comissao_idfuncao_comissao=3;") or die(mysql_error());
    while ($resultado = mysql_fetch_array($sql)) {
        $pdf->AddPage(); #Adiciona uma p�gina nova
        $pdf->Ln(30); #Quebra de Linhas
        $pdf->SetX(40); #Trava o cursor para escrever no Ponto Y
        $pdf->MultiCell(238, 10, 'Certificamos que ' . utf8_encode($resultado['nome']) . ', participou da Comissão ' . utf8_encode($resultado['descricao_comissao']) . ' durante o evento ' . utf8_encode($resultado['titulo_evento']) . ' ocorrido no periodo de ' . $resultado['comeca'] . ' e ' . $resultado['termina'] . '.', 0, 'L', 0, 0);
        $pdf->Ln(1);
        $pdf->Cell(67, 10, 'Totalizando ' . $resultado['cargahoraria'] . ' horas.', 0, 'L', 0, 0);
        $pdf->Image('img/assinatura.jpg', 110, 147, 75, 35);
        $pdf->SetY(170); #Travo o cursor para escrever no Ponto Y
        $pdf->SetFont('Arial', 'B', 14); #Seto a Fonte
        $pdf->Cell(150, 0, 'Wallace Luís de Lima', 0, 'C', 0, 0);
        $pdf->SetFont('Arial', '', 11); #Seto a Fonte
        $pdf->SetY(175); #Travo o cursor para escrever no Ponto Y
        $pdf->Cell(167, 0, 'Diretor de Pesquisa, Pós-Graduação e Extensão', 0, 'C', 0, 0);
        $pdf->SetY(180); #Travo o cursor para escrever no Ponto Y
        $pdf->Cell(152, 0, 'Port. nº 221 - DOU 02/04/2013', 0, 'C', 0, 0);
        $idcomissao = $resultado['idcomissao'];
        $idpessoa = $resultado['idpessoa'];
        $idevento = $resultado['idevento'];
        $arq = $resultado['descricao_comissao'];
        $variavel = $pdf->PageNo() . $_SESSION['UsuarioID'] . "0001SISCO";
        require ("conexao.php");
        $codigo = mysql_query("SELECT comissao_idcomissao, comissao_evento_idevento, comissao_Pessoa_idpessoa "
                . "FROM certificado WHERE codigo_validacao = '$variavel' AND comissao_Pessoa_idpessoa = $id;")or die(mysql_error());
        if ($codigo) {
            if (mysql_num_rows($codigo) == 0) {
                $insert = mysql_query("INSERT INTO certificado (comissao_idcomissao, comissao_evento_idevento, "
                        . "comissao_Pessoa_idpessoa, codigo_validacao) "
                        . "VALUES ($idcomissao, $idevento, $idpessoa, '$variavel');")or die(mysql_error());
            }
        }
    }
    ob_end_clean(); #além de limpar também mostra aquilo que foi armazenado no buffer
    $pdf->Output("Certficado_" . $arq . ".pdf", "D"); #necessário para gerar o PDF. Dentro dos parentes você consegue definir se o PDF será salvo e o nome com caminho de onde será salvo
}
