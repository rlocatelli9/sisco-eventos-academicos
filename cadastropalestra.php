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

    </head>
    <body>

        <div class="container" align="center">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
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
                                <form method="POST" action="inserirpalestra.php" >
                                    <table class="negrito">

                                        <tr>
                                            <td>Tema *  </td>
                                        <tr>
                                            <td><input name="Nome" type="text" size="20"></td>
                                        </tr><p>
                                            </tr>
                                        <tr>
                                            <td>Descrição *  </td>
                                        <tr>
                                            <td><textarea name="descricaobreve" rows="2" cols="20"></textarea></td>
                                        </tr><p>
                                            </tr>
                                        <tr>
                                            <td>Carga Horária *  </td>
                                        <tr>
                                            <td><input name="CH" type="text" size="20"></td>
                                        </tr><p>
                                            </tr>
                                        <tr>
                                            <td><input type="submit" class="buton" value="Enviar"></td>
                                        </tr>

                                    </table>
                                </form>
                                <br>
                            </div>
                        </div>
                    </div>

                </div>
                <?php include "rodape.php" ?>

                <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
                <script src="js/jquery.js"></script>
                <script src="js/bootstrap.min.js"></script>
                </body>
                </html>
