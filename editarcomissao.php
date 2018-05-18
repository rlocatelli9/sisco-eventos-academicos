<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
include 'conexao.php';
// A sess?o precisa ser iniciada em cada p?gina diferente
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
?>
<?php
if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    require ('confirmacomissao.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>SISCO Eventos Acadêmicos</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--        Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img src="img/background_cabecalho.jpg" alt="logo_Ifes"></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <?php include "./menu_usuario.php" ?>	
                            </div>
                            <div class="span9">
                                <div id="conteudo">
                                    <form name="informacoes" id="info1" method="POST">
                                        <table class="tabela_01">
                                            <tbody><tr>
                                                    <td>
                                                        <?php include './bar.php'; ?>
                                                        <br>
                                                        <?php
                                                        $idC = filter_input(INPUT_GET, 'id');
                                                        $select = mysql_query("SELECT comissao.idcomissao, comissao.portaria, comissao.funcao_comissao_idfuncao_comissao, comissao.evento_idevento, comissao.Pessoa_idpessoa, "
                                                                . "funcao_comissao.idfuncao_comissao, funcao_comissao.descricao_comissao, evento.idevento, evento.titulo, pessoa.idpessoa, pessoa.nome FROM comissao "
                                                                . "INNER JOIN funcao_comissao ON funcao_comissao.idfuncao_comissao = comissao.funcao_comissao_idfuncao_comissao "
                                                                . "INNER JOIN evento ON evento.idevento = comissao.evento_idevento "
                                                                . "INNER JOIN pessoa ON pessoa.idpessoa = comissao.Pessoa_idpessoa "
                                                                . "WHERE idcomissao=$idC;");
                                                        $linha = mysql_fetch_array($select);
                                                        ?>
                                                        <input type="hidden" name="id" value="<?php echo $idC ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="titulo"><span class="titulo_verde">EDITAR COMISSÃO</span></div><br><br></td>
                                                </tr>	<tr>
                                                    <td>
                                                        <table class="tabela_02">
                                                            <tbody><tr>
                                                                    <td><strong>INFORMAÇÕES:</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $buscar = mysql_query("SELECT idpessoa, nome FROM pessoa ORDER BY nome ASC;");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            Membro selecionado:
                                                                            <select  id="pessoa" name="pessoa">

                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($buscar)) {
                                                                                    if ($funcao['idpessoa'] == $linha['Pessoa_idpessoa']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                    <option class="fundotd td_com_input" value="<?= $funcao['idpessoa'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['nome']); ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $busc = mysql_query("SELECT idfuncao_comissao, descricao_comissao FROM funcao_comissao ORDER BY descricao_comissao ASC;");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            *Tipo de Comissão:
                                                                            <select id="funcao_comissao" name="funcao_comissao">
                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($busc)) {
                                                                                    if ($funcao['idfuncao_comissao'] == $linha['funcao_comissao_idfuncao_comissao']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                    <option class="fundotd td_com_input" value="<?= $funcao['idfuncao_comissao'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['descricao_comissao']); ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            *Portaria:<br/>
                                                                            <input id="portaria" name="portaria" class="form-control" maxlength="10" value="<?php echo utf8_encode($linha['portaria']); ?>">
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $pesq = mysql_query("SELECT idevento, titulo FROM evento ORDER BY titulo ASC;");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            *Evento correspondente:
                                                                            <select id="evento" name="evento">
                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($pesq)) {
                                                                                    if ($funcao['idevento'] == $linha['evento_idevento']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                    <option class="fundotd td_com_input" value="<?= $funcao['idevento'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['titulo']); ?></option>

                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="center">
                                                                        <input type="hidden" name="acao" value="editar" />
                                                                        <button type="submit" class="btn btn-danger" name="editar" title="Editar Ministrante">Editar Comissão</button></td>                                                                                
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <?php include "rodape.php" ?>
    </body>
</html>