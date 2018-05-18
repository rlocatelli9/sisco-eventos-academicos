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
        <title>SISCO Eventos Acadêmicos</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/validacao.js"></script>

    </head>
    <body>

        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank" ><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
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
                                <br><br>
                                <?php
                                require 'conexao.php';
                                $id = filter_input(INPUT_POST, 'id');
                                $titulo = utf8_decode(filter_input(INPUT_POST, 'titulo'));
                                $descricao = utf8_decode(filter_input(INPUT_POST, 'descricao'));
                                $dtb1 = filter_input(INPUT_POST, 'datainicio');
                                $dtb2 = filter_input(INPUT_POST, 'datafim');
                                $CH = filter_input(INPUT_POST, 'cargahoraria');
                                $sql_altera = "UPDATE evento SET titulo='$titulo', descricao='$descricao', periodoon='$dtb1', periodooff='$dtb2', cargahoraria='$CH' WHERE idevento='$id'";

                                mysql_query($sql_altera);

                                if ($sql_altera) {
                                    ?>
                                    <div align="center">
                                        <img src="img/Loading.gif" alt="carregando">
                                    </div>
                                    <script language="JavaScript">
                                        alert('Alteração realizada com sucesso!');
                                        history.back();
                                    </script>
                                    <?php
                                } else {
                                    ?>
                                    <script language="JavaScript">
                                        alert('ERRO: Não foi possível realizar a alteração!');
                                        history.back();
                                    </script>
                                    <?php
                                }
                                ?>
                                <br>
                            </div>
                        </div>
                    </div>

                </div>
                <?php include "rodape.php" ?>
            </div>
        </div>
    </body>
</html>