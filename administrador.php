<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');

include 'conexao.php';
//mysql_query("SET NAMES 'UTF-8'");
//mysql_query('SET character_set_connection=UTF-8');
//mysql_query('SET character_set_client=UTF-8');
//mysql_query('SET character_set_results=UTF-8');
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

$id = $_SESSION['UsuarioID'];
$sql = mysql_query("SELECT participacao.idparticipante, participacao.Pessoa_idpessoa, pessoa.nome, atividades.idatividades, atividades.titulo, evento.titulo, evento.periodoon "
        . "FROM participacao INNER JOIN pessoa ON pessoa.idpessoa= participacao.Pessoa_idpessoa "
        . "INNER jOIN atividades ON atividades.idatividades = participacao.atividades_idatividades "
        . "INNER JOIN evento ON evento.idevento = participacao.atividades_evento_idevento "
        . "WHERE Pessoa_idpessoa=$id;") or die(mysql_error());
$rows = mysql_num_rows($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sisco Eventos - <?php echo $_SESSION['UsuarioNome']; ?></title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--  <link rel="stylesheet" href="/resources/demos/style.css">-->
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
                                    <div>Área do Administrador:</div>
                                    <div id="nome"><?php echo $_SESSION['UsuarioNome']; ?></div>
                                    <div id="logout"><a class="link" href="logout.php">SAIR</a></div>
                                </div>
                                <span class="titulo_verde">Área do Administrador</span>
                                <br />
                                <span>Olá <strong><u><?php echo $_SESSION['UsuarioNome']; ?></u></strong>. Você Terá total acesso ao sistema.</span><br/>
                                <span>Segue as opções com as descrições abaixo do link.</span>
                                <span>Caso prefira, tem o menu à esquerda, para auxiliar em ações mais comuns.</span>
                                <div class="titulo"></div>
                                <br/>
                                <br/>
                                    <div class="span5">
                                        <span style="float: left"><a href="alteraparticipante.php"><img src="img/informacao.jpg" alt="informacoes_pessoais"></a></span>
                                        &nbsp;<span><a class="link" href="alteraparticipante.php">ACESSAR MINHAS INFORMAÇÕES</a></span>
                                        <br/>
                                        <br/>
                                        <span><i class="icon-check"></i>Clique para conferir ou alterar suas informações.</span>
                                    </div>
                                &nbsp;
                                    <div class="span4" align="left">
                                        <span><a href="all_eventos.php"><img src="img/evento.png" alt="eventos_cadastrados"></a></span>
                                        <a class="link" href="all_eventos.php">EVENTOS</a>
                                        <br/>
                                        <span><i class="icon-check"></i>Clique para gerenciar os eventos.</span>
                                    </div>
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