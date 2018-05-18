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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="logo_Ifes" src="img/background_cabecalho.jpg" ></a>
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
                                    <br>
                                    <?php
                                    $id = filter_input(INPUT_GET, 'identify');
                                    $sql = "SELECT * FROM evento where idevento = '$id';";
                                    $resultado = mysql_query($sql);
                                    $cad = mysql_query("SELECT * FROM atividades WHERE evento_idevento = '$id';");
                                    if (!$cad) {
                                        die(mysql_error());
                                    }
                                    if (mysql_num_rows($cad) == 0) {
                                        mysql_query("DELETE FROM certificado WHERE evento_idevento = '$id';");
                                        mysql_query("DELETE FROM certificado_particip_evento WHERE particip_evento_idevento = '$id';");
                                        mysql_query("DELETE FROM atividades WHERE evento_idevento = '$id';");
                                        mysql_query("DELETE FROM ministrantes WHERE atividades_evento_idevento = '$id';");
                                        mysql_query("DELETE FROM trabalho WHERE evento_idevento = '$id';");
                                        mysql_query("DELETE FROM comissao WHERE evento_idevento = '$id';");
                                        mysql_query("DELETE FROM participacao_evento WHERE idevento = '$id';");
                                        mysql_query("DELETE FROM participacao WHERE atividades_evento_idevento = '$id';");
                                        $query = "DELETE FROM evento WHERE idevento = '$id';";
                                        $result = mysql_query($query);

                                        echo 'Aguarde, por favor...';
                                        echo "<script>alert('Excluido com sucesso!')</script>";
                                        echo "<script>history.back();</script>";
                                    }

                                    if (mysql_num_rows($cad) > 0) {
                                        echo "<script>alert('Não é possível excluir este evento. Há participantes cadastrados no mesmo. Procure o administrador do sistema')</script>";
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
        </div>
    </body>
</html>

