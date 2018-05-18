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
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Eventos em Destaque</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="logo_Ifes" src="img/background_cabecalho.jpg" ></a></div>
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
                                <br>
                                <?php
                                $idpessoa = $_SESSION['UsuarioID'];
                                $idE = filter_input(INPUT_POST, 'recebeid');
                                $select = mysql_query("SELECT * FROM evento WHERE idevento=$idE");
                                $linha = mysql_fetch_array($select);
                                $idevento = $linha['idevento'];
                                $titulo_evento = $linha['titulo'];

                                if (isset($_POST['acao']) && $_POST['acao'] == 'participar') {
                                    $sql_participacao = mysql_query("INSERT INTO banco_sisco.participacao_evento (idpessoa, idevento, ativo) VALUES('$idpessoa', '$idevento', 0);") or die(mysql_error());
                                }
                                ?>
                                <span class="titulo_verde"><?php echo utf8_encode($titulo_evento); ?></span>
                                <div>
                                    <input type="hidden" name="idevento" id="input2" value="<?php echo $idevento; ?>">
                                </div>
                                <div>
                                    <?php echo utf8_encode($linha['descricao']); ?>
                                </div>
                                <div class="titulo"></div>
                                <br/>
                                <div>
                                    <span class="subtitulo">Atividades Cadastradas:</span>
                                    <br/>
                                    <?php include './selectpalestra.php'; ?>
                                </div>
                                <br/>
                                <div>
                                    <?php include './selectminicurso.php'; ?>
                                </div>
                                <br/>
                                <div>
                                    <?php include './selectmesa.php'; ?>
                                </div>
                                <br/>
                                <div align="left">
                                    <form name="voltar" method="POST" action="prevevento.php">
                                        <input type="submit" class="btn btn-success" value="voltar">
                                    </form>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include "rodape.php" ?>
        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>