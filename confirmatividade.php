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
                                
//                                function ReverteData($data) {
//                                    $rData = explode("-", $data);
//                                    $rData = $rData[2] . '-' . $rData[1] . '-' . $rData[0];
//                                    return $rData;
//                                }
//                                $dtb1 = ReverteData($dt);
                                require 'conexao.php';
                                $id = filter_input(INPUT_POST, 'id');
                                $titulo = utf8_decode(filter_input(INPUT_POST, 'titulo'));
                                $descricao = utf8_decode(filter_input(INPUT_POST, 'descricao'));
                                $dt = filter_input(INPUT_POST, 'data');
                                $ini = filter_input(INPUT_POST, 'inicio');
                                $fim = filter_input(INPUT_POST, 'fim');
                                $CH = filter_input(INPUT_POST, 'cargahoraria');
                                $sql_altera = "UPDATE atividades SET titulo='$titulo', descricao='$descricao', data='$dt', inicio='$ini', fim='$fim', cargahoraria='$CH' WHERE idatividades='$id'";
                                mysql_query($sql_altera);
                                if ($sql_altera) {
                                    echo '<script>alert("Alteração realizada com sucesso!")</script>';
                                    echo "<script>history.back();</script>";
                                } else {
                                    echo '<script>alert("Não foi possível realizar a alteração! Erro: ")</script>' . mysql_error();
                                    echo "<script>history.back();</script>";
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