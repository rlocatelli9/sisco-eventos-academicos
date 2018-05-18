<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
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
$id = (isset($_GET['id']) ? $_GET['id'] : NULL);
if ($id == NULL) {
    echo 'Não deu para pegar o ID.';
    exit();
} else {
    include'conexao.php';
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
                                        $sql = "SELECT * FROM comissao WHERE idcomissao = '$id'";
                                        $resultado = mysql_query($sql)or die(mysql_error());
                                        if (mysql_num_rows($resultado) == 0) {
                                            echo 'Aguarde, por favor...';
                                            ?>
                                            <img src="img/Loading.gif" alt="carregando">
                                            <?php
                                            echo "<script>alert('Não encontramos o membro da comissão.')</script>";
                                            echo "<script>history.back();</script>";
                                        } else {
                                            $registro = mysql_fetch_array($resultado);
                                            $query = "DELETE FROM comissao WHERE idcomissao = '$id'";
                                            $result = mysql_query($query);
                                            echo 'Aguarde, por favor...';
                                            ?>
                                            <img src="img/Loading.gif" alt="carregando">
                                            <?php
                                            echo "<script>alert('Excluido com sucesso!')</script>";
                                            echo "<script>history.back();</script>";
                                        }
                                        ?>
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
    <?php
}
