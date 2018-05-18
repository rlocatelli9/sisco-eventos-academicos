<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
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
<?php
if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    require ('confirmaparticipante.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SISCO Eventos Acadêmicos - Relatórios</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/validacao.js"></script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img src="img/background_cabecalho.jpg" alt="logo_Ifes"></a></div>
            <!--<header class="row-fluid">
         
            </header>-->
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <?php include "./menu_usuario.php" ?>	
                            </div>
                            <div class="span9">
                                <?php include './bar.php'; ?>
                                <span class="titulo_verde">Área de Relatórios</span>
                                <br/>
                                <span>Olá <strong><u><?php echo $_SESSION['UsuarioNome']; ?></u></strong>. Você Terá total acesso ao sistema.</span><br/>
                                <span>Segue as opções com as descrições abaixo do link.</span>
                                <div class="titulo"></div>
                                <br/>
                                <div class="span5" align="center">
                                    <span><img src="img/icon_documentos.jpg" alt="relatorio"></span>
                                    <a class="link" href="relatorio_usuarios_ativos.php" target="_blank">USUÁRIOS ATIVOS</a>
                                    <br/>
                                    <br/>
                                    <div align="left">
                                        <a href="all_eventos.php" class="btn btn-success"><span><i class="icon-backward"></i> Voltar</span></a>
                                    </div>
                                </div>
                                <div class="span4" align="center">
                                    <span><img src="img/icon_documentos.jpg" alt="relatorio"></span>
                                    <a class="link" href="relatorio_eventos_ativos.php" target="_blank">EVENTOS ATIVOS</a>
                                </div>
                                <div class="span9">
                                    <div align="center">
                                        <a href="https://get.adobe.com/br/reader/" target="_blank"><img src="img/get_adobe_reader.gif" alt="download_reader"></a>
                                    </div>
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
