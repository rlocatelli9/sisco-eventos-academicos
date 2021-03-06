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
//                                $data_nasc = filter_input(INPUT_POST, 'datanascimento');
//
//                                function ReverteData($data) {
//                                    $rData = explode("-", $data);
//                                    $rData = $rData[0] . '-' . $rData[1] . '-' . $rData[2];
//                                    return $rData;
//                                }
//
//                                $dtb = exibirData($data_nasc);

                                require 'conexao.php';
                                $id = filter_input(INPUT_POST, 'idpessoa');
                                $nome = utf8_decode(filter_input(INPUT_POST, 'nomecompleto'));
                                $data_nasc = filter_input(INPUT_POST, 'datanascimento');
                                $cidade = utf8_decode(filter_input(INPUT_POST, 'cidade'));
                                $estado = filter_input(INPUT_POST, 'estado');
                                $tel = filter_input(INPUT_POST, 'telCel');
                                $instituicao = utf8_decode(filter_input(INPUT_POST, 'instituicao'));
                                $sql_altera = "UPDATE pessoa SET nome='$nome', data_nasc='$data_nasc', cidade='$cidade', estado='$estado', telefone='$tel', Nome_Instituicao='$instituicao' WHERE idpessoa='$id'";

                                mysql_query($sql_altera);


                                if ($sql_altera) {
                                    echo '<script>alert("Alteração realizada com sucesso!")</script>';
                                    echo "<script>window.location.href='participante.php'</script>";
                                } else {
                                    echo '<script>alert("Não foi possível realizar a alteração! Erro: ")</script>' . mysql_error();
                                    echo "<script>history.go(-1);</script>";
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
