<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Evento</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
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
                                $conect = new mysqli('localhost', 'root', 'root', 'banco_sisco');
                                if (!$conect) {
                                    die('erro ao conectar ao banco de dados');
                                }
                                include("conexao.php");
                                $essaquery = "INSERT INTO ministrantes (descricao_resumida, funcao_ministrante_idfuncao_ministrante, atividades_idatividades, "
                                        . "atividades_evento_idevento, grau_formacao_idgrau_formacao, Pessoa_idpessoa)"
                                        . "VALUES ('" . utf8_decode(filter_input(INPUT_POST, 'descricao')) . "',
                                                      '" . filter_input(INPUT_POST, 'funcao') . "',
                                                      '" . filter_input(INPUT_POST, 'atividade') . "',
                                                      '" . filter_input(INPUT_POST, 'evento') . "',
                                                      '" . filter_input(INPUT_POST, 'formacao') . "',
                                                      '" . filter_input(INPUT_POST, 'pessoa') . "')";
                                mysql_query($essaquery);
                                //}
                                if ($essaquery) {
                                    echo 'Aguarde, por favor...';
                                    echo "<script>alert('Ministrante cadastrado!')</script>";
                                     echo "<script>history.go(-1)</script>";
                                } else {
                                    session_start(); // Inicia a sess�o
                                    session_destroy(); // Destr�i a sess�o limpando todos os valores salvos
                                    echo "<script>alert('Nao foi possível capturar os dados. Tente novamente mais tarde.')</script>";
                                    echo "<script>window.location.href='index.php'</script>";
                                    exit(); // Redireciona o visitante
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
