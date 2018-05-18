<!DOCTYPE html>
<html>
    <head>

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

    </head>
    <body>

        <div class="container" align="center">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank" ><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <!--<header class="row-fluid">
         
            </header>-->
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
                                <br><br>

                                <!--                                <form id="form1" name="form1" method="post" action="listafazenda.php">
                                                                    <input type="submit" name="button" id="button" value="Voltar" />
                                                                </form>-->
                                <?php
                                require 'conexao.php';
                                $id = filter_input(INPUT_POST, 'recebe');
                                $nome = filter_input(INPUT_POST, 'nomenovo');
                                $proprietario = filter_input(INPUT_POST, 'proprietarionovo');
                                $sql_altera = "UPDATE fazenda.fazenda SET nome='$nome', proprietario='$proprietario' WHERE idfazenda='$id'";

                                $resultado = mysql_query($sql_altera);

                                echo " ALTERAÇÃO FEITA COM SUCESSO <br> ";
                                ?>

                                <a href="preconsultaparticipante.php" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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
