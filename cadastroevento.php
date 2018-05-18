<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
include 'conexao.php';
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
if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    require ('cadastrarevento.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Cadastro de eventos</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--        Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script>
        <script>
            $(function () {
                $("#comeca").datepicker();
            });
            $(function () {
                $("#termina").datepicker();
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg"></a></div>
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
                                <br />
                                <?php include './bar.php'; ?>
                                <br />
                                <form class="form-horizontal" id="cadastro" name="cadastro" method="POST" action="" onsubmit="return validaCampo();
                                        return false;">

                                    <table id="t01" style="margin-left: 40%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Cadastro de Evento</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br/>
                                    <div class="form-group">
                                        <label for="InputNome">Nome do Evento</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Nome do Evento" onkeyup="toUpper(this);">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDescricao">Descrição</label>
                                        <textarea id="descricao" name="descricao" class="form-control" placeholder="Faça uma breve descrição do evento"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="Inputprazoini">Data de Início</label>
                                        <input type="date"  name="periodoon" id="comeca">

                                        <label for="Inputprazoff">Data de fim</label>
                                        <input type="date" name="periodooff" id="termina">
                                    </div>
                                    <div class="form-group">
                                        <label for="InputDescricao">Carga Horária</label>
                                        <input id="cargahoraria" name="cargahoraria" class="form-control" placeholder="Informe somente número inteiro">
                                    </div>
                                    <input type="hidden" name="acao" value="cadastrar" />
                                    <button type="submit" class="btn btn-success" name="cadastrar" title="Cadastrar">Enviar Cadastro</button>
                                </form>
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
