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
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Eventos em Destaque</title>
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
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="logo_Ifes" src="img/background_cabecalho.jpg"></a></div>           
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
                                <?php
                                $id = filter_input(INPUT_POST, 'recebeid');
                                $sql_evento = mysql_query("SELECT * FROM evento WHERE idevento=$id;");
                                $array = mysql_fetch_array($sql_evento);
                                ?>
                                <span class="titulo_verde"><?php echo utf8_encode($array['titulo']); ?></span>
                                <div>
                                    <?php $idevento = $array['idevento']; ?>
                                    <input type="hidden" name="idevento" id="input2" value="<?php echo $idevento; ?>">
                                    <span style="font-size: 10px"><a href="editarevento.php?id=<?php echo $idevento; ?>">(Editar Informações) <i class="icon-edit"></i></a></span>
                                </div>
                                <span>Página para gerenciamento do Evento.</span><br/>
                                <span>Nesta página, poderá adicionar Atividades, Ministrantes, Comissão</span>
                                <div class="titulo"></div>
                                <br/>
                                <div>
                                    <input type="hidden" name="idevento" id="input3" value="<?php echo $idevento; ?>">
                                    <span class="icon-check"></span>
                                    <a class="link" href="infoevento.php?id=<?php echo $idevento; ?>">EXIBIR INFORMAÇÕES SOBRE O EVENTO</a>
                                    <br/>
                                    Clique para conferir as informações.                                    
                                </div>
                                <br/>
                                <div>
                                    <form name="form3" method="GET" action="">
                                        <span class="icon-check"></span>
                                        <a class="link" href="cadastroatividade.php">ADICIONAR ATIVIDADE</a>
                                        <br/>
                                        Clique para adicionar as informações.
                                        <input type="hidden" name="id3" id="input4" value="<?php echo $id; ?>">
                                    </form>
                                </div>
                                <br/>
                                <div>
                                    <form name="form4" method="GET" action="">
                                        <span class="icon-check"></span>
                                        <a class="link" href="cadastroministrante.php">ADICIONAR MINISTRANTE</a>
                                        <br/>
                                        Clique para adicionar as informações.
                                        <input type="hidden" name="id4" id="input5" value="<?php echo $id; ?>">
                                    </form>
                                </div>
                                <br/>
                                <div>
                                    <form name="form5" method="post" action="">
                                        <span class="icon-check"></span>
                                        <a class="link" href="cadastrocomissao.php">ADICIONAR COMISSÃO</a>
                                        <br/>
                                        Clique para adicionar as informações.
                                        <input type="hidden" name="id5" id="input6" value="<?php echo $id; ?>">
                                    </form>
                                </div>
                                <br/>
                                <div>
                                    <!--<form name="form6" method="GET" action="">-->
                                    <span class="icon-check"></span>
                                    <a class="link" href="presenca_atividades.php?id=<?php echo $id; ?>">GERAR E CONFIRMAR LISTA DE PRESENÇA</a>
                                    <br/>
                                    Clique para gerar lista e/ou confirmar a presença de participantes.

<!--                                        <input type="hidden" name="id6" id="input7" value="<?php // echo $id;      ?>">
</form>-->
                                </div>
                                <br/>
                                <div align="left">
                                    <form name="voltar" method="POST" action="all_eventos.php">
                                        <button type="submit" name="voltar" class="btn btn-success" title="Voltar página"><span class="icon-backward"></span> VOLTAR</button>
                                    </form>
                                    <br/>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "rodape.php" ?>
                <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
                <script src="js/jquery.js"></script>
                <script src="js/bootstrap.min.js"></script>
            </div>
        </div>
    </body>
</html>