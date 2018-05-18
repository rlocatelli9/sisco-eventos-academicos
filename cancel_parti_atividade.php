<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
include 'conexao.php';

// A sess?o precisa ser iniciada em cada p?gina diferente
if (!isset($_SESSION)) {
    session_start();
}

//$nivel_necessario = 2;
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
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISCO Eventos Acadêmicos</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script>

    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <!--<header class="row-fluid">
         
            </header>-->
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
                                <?php include './bar.php'; ?>
                                <br>
                                <?php
                                if (isset($_GET['id']) && isset($_GET['idE'])) {
                                    $idparticipacao = $_GET['id'];
                                    $id_E = $_GET['idE'];
                                    $delete = mysql_query("DELETE FROM participacao WHERE idparticipante=$idparticipacao and atividades_evento_idevento=$id_E;") or die(mysql_error()); //cancela a participação em atividade selecionada 
                                    echo '<script>alert("Participação na atividade, cancelada.")</script>';
                                    ?>
                                    <form name="form1" method="POST" action="participoevento.php">
                                        <?php echo '<p style="text-align: center; font-size: 18px"><b>Participação na atividade, cancelada.</b>'; ?>
                                        <input type="hidden" name="recebeid" id="recebeid" value="<?php echo $id_E; ?>">
                                        <br/>
                                        <br/>
                                        <input class="btn btn-success" type="submit" name="voltar" value="Voltar" title="Voltar para página anterior">

                                        <?php
                                    } else {
                                        echo "<script>alert('Não foi possível capturar os dados da participação.')</script>";
                                        echo '<p style="text-align: center; font-size: 18px"><b>Não foi possível capturar os dados da participação.</b>';
                                        ?>
                                        <input type="hidden" name="recebeid" id="recebeid2" value="<?php echo $id_E; ?>">
                                        <br/>
                                        <br/>
                                        <input class="btn btn-success" type="submit" name="voltar" value="Voltar" title="Voltar para página anterior">
                                        <?php
                                    }
                                    ?>
                                </form>
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