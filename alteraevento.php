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
require'conexao.php';
$query = mysql_query("SELECT idevento, titulo FROM evento;")or die(mysql_error());
?>
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
        <style type="text/css">
            #page {
                width: 100%;
                margin: 20px auto;
            }
            #mostra {
                display: none;
                position: absolute;
                width: 600px;
                height: 380px;
                border: 1px solid #666;
                top: 0;
                left: 0;
                background-color: #f1f1f1;
                box-shadow: 0 0 2px #999;
                text-align: center;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mostrar").click(function () {
                    var w = $(window).width();
                    var h = $(window).height();
                    var left = (w - $("#mostra").width()) / 1.60;
                    var top = (h - $("#mostra").height()) / 0.90;
                    $("#mostra").css({
                        display: "block",
                        left: left,
                        top: top
                    })
                            .load("eventomostra.php?id=" + $("select").val())
                });
            });
            
        </script>
        <script type="text/javascript">
            function fechar() {
                $("#mostra").css({
                    display: "none"
                });
                document.alterarevento.id.value="";
                document.alterarevento.titulo.value="";
                document.alterarevento.descricao.value="";
                document.alterarevento.datainicio.value="";
                document.alterarevento.datafim.value="";
                document.alterarevento.cargahoraria.value="";
            }
        </script>
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
<?php include "./menu_usuario.php" ?>
                                </div>
                            </div>
                            <div class="span9" >
                                <?php include './bar.php';?>
                                <div id="page" align="center">

                                    <label>Selecione o Evento</label>
                                    <select>
                                        <option value="#">Selecione...</option>
                                        <?php while ($evento = mysql_fetch_array($query)) { ?>
                                            <option value="<?php echo $evento['idevento']; ?>"><?php echo utf8_encode($evento['titulo']); ?></option>
<?php } ?>
                                    </select>
                                    <a href="javascript:func()" id="mostrar"><img src="img/search.png" alt="procurar" style="width: 50px; height: 50px"></a>
                                    <!--<button id="mostrar" class="btn btn-info">Mostrar</button>-->
                                </div>
                                <div id="mostra"></div>
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