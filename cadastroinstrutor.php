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
                                
                                <h4>Cadastro de Instrutor</h4>
                                <br />

                                <form method="POST" action="inseririnstrutor.php" >
                                    <div align="center">
                                        <table class="negrito">

                                            <tr>
                                                <td>Nome</td>
                                                <td>Sexo</td>
                                            <tr>
                                                <td><input id="Name" name="Nome" type="text" size="40" placeholder="Insira seu nome"></td>
                                                <td>
                                                    <input type="radio" name="sexo" value="Masculino"> Masculino
                                                    <input type="radio" name="sexo" value="Feminino"> Feminino
                                                </td>
                                            </tr><p>
                                                </tr>
                                            <tr>
                                                <td>Identidade</td>
                                                <td>Celular</td>
                                            <tr>
                                                <td><input name="RG" type="text" size="20"></td>
                                                <td><input name="Celular" type="text" size="20" placeholder="DDD-xxxxxxxxx"></td>
                                            </tr><p>
                                                </tr>
                                            <tr>
                                                <td>Telefone</td>

                                            <tr>
                                                <td><input name="Telefone" type="tel" size="20" placeholder="DDD-xxxxxxxx"></td>

                                            </tr><p>
                                                </tr>
                                            <tr>
                                                <td>Email *</td>
                                                <td>Email Secundário (OPCIONAL)</td>
                                            <tr>
                                                <td><input name="Email" type="email" size="20"></td>
                                                <td><input name="Email2" type="email" size="20"></td>
                                            </tr><p>
                                                </tr>
                                            <tr>
                                                <td>Instituição de Formação 
                                                    <select name="Origem"size="1">
                                                        <option value="Selection1">Selecione...</option>
                                                        <option value="Ifes">IFES - Campus de Alegre</option>
                                                        <option value="Outra">Outra</option>
                                                    </select></td><p>

                                            <td>Nivel:
                                                <select name="Nivel" size="1">
                                                    <option value="Selection2">Selecione...</option>
                                                    <option value="Especializacao">Especialista</option>
                                                    <option value="Graduacao">Graduado</option>
                                                    <option value="Pos">Pós Graduado</option>
                                                    <option value="Mestrado">Mestre</option>
                                                    <option value="Doc">Doutor</option>
                                                    <option value="PosDoc">Pós Doutor</option>
                                                </select>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td>Caso venha de Instituição Externa, Especifique:</td>
                                                <td><input name="Externa" type="text" size="40"></td><p>
                                                </tr>
                                            <tr>
                                                <td>Formação:<textarea name="Curso" rows="1" cols="20"></textarea></td>

                                            </tr><p>
                                            <tr>
                                                <td><input type="submit" class="buton" value="Enviar"></td>
                                            </tr>

                                        </table>
                                    </div>
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
