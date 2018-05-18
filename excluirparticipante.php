<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
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
                                        <?php include "menu.php" ?>
                                    </div>                                   
                                </div>
                                <div class="span9">
                                    <br>
                                    <?php
                                    $id = filter_input(INPUT_GET, 'identify');
                                    $sql = "select * from pessoa where idpessoa = '$id'";
                                    $resultado = mysql_query($sql);
                                    $registro = mysql_fetch_array($resultado);
                                    $query = "DELETE FROM pessoa WHERE idpessoa = '$id'";
                                    $result = mysql_query($query);
                                    ?>
                                    <div align="center">
                                        <img src="img/Loading.gif" alt="carregando">
                                    </div>
                                    <script language="JavaScript">
                                        alert('Excluido com sucesso!');
                                        history.back();
                                    </script>
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