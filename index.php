<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Sisco Eventos - Página Inicial</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--        Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script> 
    </head>
    <body>
        <div class="container" >
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda" >
                                    <?php include "menu.php" ?>
                                </div>
                            </div>
                            <div class="span9">
                                <h3>Página Inicial</h3>
                                <br>
                                <div align="center">
                                    <img src="img/logomarca.jpg" alt="logo_sisco">
                                </div>
<!--                                <p style="font-size: 14px; text-align: justify">Olá, participante. Este sistema foi desenvolvido para facilitar o cadastro em eventos acadêmicos, realizados pelo Instituto
                                    Federal do Espírito Santo - IFES - Campus de Alegre.
                                <p style="font-size: 14px; text-align: justify">O Sistema para Controle de Eventos Acadêmicos e Emissões de Certificados Online, o <b><u>SISCO Eventos Acadêmicos</u></b>, chegou para proporcionar
                                    praticidade e comodidade para você, participante e organizador.-->
                                <p style="font-size: 14px; text-align: justify">É realizado apenas um único cadastro e nos próximos eventos, não será mais necessário, cadastrar-se novamente.  
                                <p style="font-size: 14px; text-align: justify">Logo após confirmado o cadastro, seus dados serão vinculados automaticamente e você, participante, 
                                    após autenticado, poderá escolher em qual evento disponivel, quer se cadastrar e quais atividades realizar.
                                <p style="font-size: 14px; text-align: justify">Os <b><u>Certificados</u></b> referentes a participações serão gerados via sistema. Sendo disponibilizado na <b><u>ÁREA DO(A) USUÁRIO(A)</u></b>, 
                                    fica o(a) usuário(a) responsável pela emissão em até <b><u>90 dias após</u></b> o término do evento em que participou.
                                <div style="background-color: #A9F3A9">
                                    <p style="font-size: 14px; font-weight: bold; color: red; text-align: justify">O SISCO Eventos Acadêmicos, não se responsabiliza por emissões passados os 90 dias posteriores ao término do Evento.
                                </div>
                                <br />
                            </div>
                        </div>
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