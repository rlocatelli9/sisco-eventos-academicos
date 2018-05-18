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
$id = $_SESSION['UsuarioID'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Área do(a) <?php echo $_SESSION['UsuarioNome'] ?></title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#accordion").accordion({
                    heightStyle: "content"
                });
            });
        </script>
        <!--        Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
                <style type="text/css">
            #preloader {
                position: absolute;
                left: 0px;
                right: 0px;
                bottom: 0px;
                top: 0px;
                background: #ccc;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function () {

                //Esconde preloader
                $(window).load(function () {
                    $('#preloader').fadeOut(5000);//5000 é a duração do efeito (5 seg)
                });

            });
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
                                    <?php include "menu_usuario.php" ?>
                                </div>
                            </div> 
                            <div class="span9">
                                <div id="preloader" align="center">
                                    <h1><img src="img/support-loading.gif" alt="carregando"></h1>
                                </div>
                                <div id="bar">
                                    <div>Área do(a) Usuário(a):</div>
                                    <div id="nome"><?php echo $_SESSION['UsuarioNome']; ?></div>
                                    <div id="logout"><a class="link" href="logout.php">SAIR</a></div>
                                </div>
                                <span class="titulo_verde">Área do Participante</span>
                                <br />
                                <span>Aqui você poderá encontrar as opções disponíveis para seu login.</span>
                                <span>Caso prefira, tem o menu à esquerda, para auxiliar em ações mais comuns.</span>
                                <div class="titulo"></div>
                                <br/>
                                <div>
                                    <span class="icon-check"></span>
                                    <a class="link" href="alteraparticipante.php">ACESSAR MINHAS INFORMAÇÕES</a>
                                    <br/>
                                    Clique para conferir ou alterar suas informações.
                                </div>
                                <br/>
                                <div>
                                    <span class="icon-check"></span>
                                    <a class="link" href="meutrabalho.php">MEUS TRABALHOS</a>
                                    <br/>
                                    Clique para obter informações sobre os trabalhos enviados.
                                </div>
                                <br/>
                                <div>
                                    <span class="icon-check"></span>
                                    <a class="link" href="prevevento.php">EVENTOS DISPONÍVEIS</a>
                                    <br/>
                                    Clique para obter informações sobre os trabalhos enviados.
                                </div>
                                <br/>
                                <div>
                                    <span class="icon-check"></span>
                                    <a class="link" href="meucertificado.php">MEUS CERTIFICADOS</a>
                                    <br/>
                                    Clique para verificar seus certificados.
                                </div>
                                <br/>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include "rodape.php" ?>
    </body>
</html>