<!DOCTYPE html>
<html>
    <head>
         <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Palestra</title>
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
                                //verificando email e recolhendo valor
                                $titulo = filter_input(INPUT_POST, 'Titulo');
                                # Verificando apenas um campo, no caso dado1.
                                $sql = $conect->query("SELECT * FROM evento WHERE titulo='$titulo'");
                                if (mysqli_num_rows($sql) > 0) {
                                    echo '<script>alert("Este evento já foi cadastrado!")</script>';
                                    echo '<script>history.go(-1);</script>';
                                } else {
                                    $data=filter_input(INPUT_POST, 'data');
                                    include("conexao.php");
                                    $essequeli = "INSERT INTO atividades (titulo, cargahoraria, descricao_atividade, tipo_atividade_idtipo, evento_idevento, data, inicio, fim, ativo)
                                    VALUES ('" . utf8_decode(filter_input(INPUT_POST, 'titulo')) . "',
                                            '" . filter_input(INPUT_POST, 'cargahoraria') . "',
                                            '" . utf8_decode(filter_input(INPUT_POST, 'descricao')) . "',
                                            '" . filter_input(INPUT_POST, 'atividade') . "',
                                            '" . filter_input(INPUT_POST, 'evento') . "',    
                                            '" . filter_input(INPUT_POST, 'data') . "',
                                            '" . filter_input(INPUT_POST, 'inicio') . "',
                                            '" . filter_input(INPUT_POST, 'fim') . "',
                                            1)";
                                    mysql_query($essequeli);
                                }
                                if ($essequeli) {
                                    echo 'Aguarde, por favor...';
                                    echo "<script>alert('Atividade Cadastrada!')</script>";
                                    echo "<script>history.go(-1)</script>";
                                } else {
                                    session_start(); // Inicia a sess�o
                                    session_destroy(); // Destr�i a sess�o limpando todos os valores salvos
                                    echo "<script>alert('Nao foi possível capturar os dados. Tente novamente mais tarde.')</script>";
                                    echo "<script>window.location.href='index.php'</script>";
                                    exit; // Redireciona o visitante
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