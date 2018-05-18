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
if (isset($_POST['acao']) && $_POST['acao'] == 'adicionar') {
    require ('cadastrarcomissao.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Cadastro de Ministrante</title>
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
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg"></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda">
                                    <?php include "./menu_usuario.php" ?>
                                </div>                             
                            </div>                          
                            <div class="span9">
                                <?php include './bar.php'; ?>
                                <br />
                                <form class="form-horizontal" id="cadastro" name="cadastro" method="POST" action="" onsubmit="return validaCampo();
                                        return false;">

                                    <table id="t01" style="margin-left: 40%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center" colspan="2">Adicionar membro de Comissão</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br/>
                                    <div class="form-group">
                                        <label for="InputPortaria">Portaria</label>
                                        <input id="portaria" name="portaria" class="form-control" maxlength="10" >
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        #chama o arquivo de configura��o com o banco
                                        require 'conexao.php';

                                        #seleciona os dados da tabela produto
                                        $pesq = mysql_query("SELECT * FROM funcao_comissao ORDER BY idfuncao_comissao ASC;");


                                        # abaixo montamos um formul�rio em html
                                        # e preenchemos o select com dados
                                        ?>
                                        <label for="InputFuncao">Selecione a função da comissão</label>
                                        <select id="funcao" name="funcao_comissao">
                                            <option>Selecione...</option>

                                            <?php while ($funcao = mysql_fetch_array($pesq)) { ?>
                                                <option value="<?php echo $funcao['idfuncao_comissao'] ?>"><?php echo utf8_encode($funcao['descricao_comissao']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        #chama o arquivo de configura��o com o banco
                                        require 'conexao.php';

                                        #seleciona os dados da tabela produto
                                        $pesq = mysql_query("SELECT idevento, titulo FROM evento ORDER BY titulo ASC;");


                                        # abaixo montamos um formul�rio em html
                                        # e preenchemos o select com dados
                                        ?>
                                        <label for="InputTipo">Selecione o Evento correspondente</label>
                                        <select id="evento" name="evento">
                                            <option>Selecione...</option>

                                            <?php while ($funcao = mysql_fetch_array($pesq)) { ?>
                                                <option value="<?php echo $funcao['idevento'] ?>"><?php echo utf8_encode($funcao['titulo']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <?php
                                        #chama o arquivo de configura��o com o banco
                                        require 'conexao.php';

                                        #seleciona os dados da tabela produto
                                        $buscar = mysql_query("SELECT idpessoa, nome FROM pessoa ORDER BY nome ASC;");


                                        # abaixo montamos um formul�rio em html
                                        # e preenchemos o select com dados
                                        ?>
                                        <label for="InputPessoa">Selecione o ministrante</label>
                                        <select id="funcao" name="pessoa">
                                            <option>Selecione...</option>

                                            <?php while ($funcao = mysql_fetch_array($buscar)) { ?>
                                                <option value="<?php echo $funcao['idpessoa'] ?>"><?php echo utf8_encode($funcao['nome']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                    <input type="hidden" name="acao" value="adicionar" />
                                    <button type="submit" class="btn btn-success" name="adicionar" title="Adicionar">Adicionar Membro da Comissão</button>
                                </form>
                                <br>
                                <div align="left">
                                    <span class="icon-backward"></span>
                                    <a class="link" href="all_eventos.php">EXIBIR TODOS EVENTOS</a>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "rodape.php" ?>
    </body>
</html>