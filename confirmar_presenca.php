<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
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
// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante pra home
//$id = (isset($_GET['id']) ? $_GET['id'] : NULL);
//if ($id == NULL) {
//
//    echo 'Não deu para pegar o ID do Evento.';
//    exit();
//}
include './conexao.php';
//
////$idE = filter_input(INPUT_GET, 'id');
//$select = mysql_query("SELECT * FROM evento WHERE idevento=$id");
//$linha = mysql_fetch_array($select);
//
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISCO Eventos Acadêmicos</title>
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
                                if (isset($_POST['presente'])) {
                                    $x = $_POST['presente'];
                                    for ($i = 0; $i < count($x); $i++) {
                                        include './conexao.php';
                                        $update="UPDATE banco_sisco.participacao SET presenca=1 "
                                        . "WHERE idparticipante=$x[$i];";
                                        mysql_query($update);
                                        
                                        $seleciona=mysql_query("SELECT idparticipante, Pessoa_idpessoa FROM participacao WHERE idparticipante=$x[$i]");
                                        $res=mysql_fetch_array($seleciona);
                                        $people=$res['Pessoa_idpessoa'];
                                    
                                        $update2="UPDATE banco_sisco.participacao_evento SET ativo=1 "
                                        . "WHERE idpessoa=$people;";
                                        mysql_query($update2);
                                    }
                                    echo '<script>alert("Participações confirmadas com sucesso!")</script>';
                                    echo '<script>history.go(-1);</script>';
                                } else {
                                    echo "<script>alert('Não detectamos checkbox marcado!')</script>";
                                    echo '<script>history.go(-1);</script>';
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