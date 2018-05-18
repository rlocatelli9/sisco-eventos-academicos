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
                                //verificando email e recolhendo valor
                                $titulo = filter_input(INPUT_POST, 'titulo');
                                # Verificando apenas um campo, no caso dado1.
                                $sql = $conect->query("SELECT * FROM evento WHERE titulo='$titulo'");
                                if (mysqli_num_rows($sql) > 0) {
                                    echo '<script>alert("Este evento já foi cadastrado!")</script>';
                                    echo '<script>history.back();</script>';
                                } else {
                                    
//                                    $dataini = filter_input(INPUT_POST, 'periodoon');
//                                    function exibeinicio($data) {
//                                        $rData = explode("-", $data);
//                                        $rData = $rData[0] . '-' . $rData[1] . '-' . $rData[2];
//                                        return $rData;
//                                    }
//                                    $dtiniFormatada = exibeinicio($dataini);
//                                    
//                                    $datafim = filter_input(INPUT_POST, 'periodooff');
//                                    function exibefim($datafim) {
//                                        $rData = explode("-", $datafim);
//                                        $rData = $rData[0] . '-' . $rData[1] . '-' . $rData[2];
//                                        return $rData;
//                                    }
//                                    $dtfimFormatada = exibefim($datafim);
                                    
                                    include("conexao.php");
                                    $essaquery = "INSERT INTO evento (titulo, descricao, periodoon, periodooff, cargahoraria, ativo)
                                    VALUES ('" . utf8_decode(filter_input(INPUT_POST, 'titulo')) . "',
                                            '" . utf8_decode(filter_input(INPUT_POST, 'descricao')) . "',
                                            '" . filter_input(INPUT_POST, 'periodoon') . "',
                                            '" . filter_input(INPUT_POST, 'periodooff') . "',
                                            '" . filter_input(INPUT_POST, 'cargahoraria') . "',
                                            1)";
                                    mysql_query($essaquery);
                                }
                                if ($essaquery) {
                                    echo 'Aguarde, por favor...';
                                    echo "<script>alert('Evento cadastrado!')</script>";
                                    echo "<script>window.location.href='all_eventos.php'</script>";
                                } else {
                                    session_start(); // Inicia a sess�o
                                    session_destroy(); // Destr�i a sess�o limpando todos os valores salvos
                                    echo 'Aguarde, por favor...';
                                    echo "<script>alert('Nao foi possível capturar os dados. Tente novamente mais tarde.')</script>";
                                    echo "<script>history.back()</script>";
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