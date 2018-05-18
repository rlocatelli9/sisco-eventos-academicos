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
$id = $_SESSION['UsuarioID'];
$sql = mysql_query("SELECT participacao.idparticipante, participacao.Pessoa_idpessoa, pessoa.nome, atividades.idatividades, atividades.titulo, evento.titulo, evento.periodoon "
        . "FROM participacao INNER JOIN pessoa ON pessoa.idpessoa= participacao.Pessoa_idpessoa "
        . "INNER jOIN atividades ON atividades.idatividades = participacao.atividades_idatividades "
        . "INNER JOIN evento ON evento.idevento = participacao.atividades_evento_idevento "
        . "WHERE Pessoa_idpessoa=$id AND pessoa.ativo=1 AND participacao.presenca=1;") or die(mysql_error());
$rows = mysql_num_rows($sql);
$sql_minist = mysql_query("SELECT idministrantes, Pessoa_idpessoa FROM ministrantes WHERE Pessoa_idpessoa=$id;");
$rows2 = mysql_num_rows($sql_minist);
$sql_comissao = mysql_query("SELECT idcomissao, Pessoa_idpessoa FROM comissao WHERE Pessoa_idpessoa=$id AND funcao_comissao_idfuncao_comissao=3;");
$rows3 = mysql_num_rows($sql_comissao);
$sql_part_evento = mysql_query("SELECT idparticipacao, idpessoa FROM participacao_evento WHERE idpessoa=$id AND ativo=1;");
$rows4 = mysql_num_rows($sql_part_evento);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Área do(a) <?php echo $_SESSION['UsuarioNome']; ?></title>
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
                                <?php if ($rows > 0) { ?>
                                    <div>
                                        <span class="icon-check"></span>
                                        <a class="link" href="certificadao.php?id=<?php echo $id; ?>" target="_blank">MEUS CERTIFICADOS DE PARTICIPAÇÃO EM ATIVIDADES</a>
                                        <br/>
                                        Clique para verificar seus certificados.
                                    </div>
                                    <br/>
                                    <?php
                                }
                                if ($rows2 > 0) {
                                    ?>
                                    <div>
                                        <span class="icon-check"></span>
                                        <a class="link" href="certificado_ministrante.php?id=<?php echo $id; ?>" target="_blank">MEUS CERTIFICADOS DE MINISTRANTE</a>
                                        <br/>
                                        Clique para verificar seus certificados.
                                    </div>
                                    <br/>
                                    <?php
                                }
                                if ($rows3 > 0) {
                                    ?>
                                    <div>
                                        <span class="icon-check"></span>
                                        <a class="link" href="certificado_comissao.php?id=<?php echo $id; ?>" target="_blank">MEUS CERTIFICADOS DE COMISSÃO DE APOIO</a>
                                        <br/>
                                        Clique para verificar seus certificados.
                                    </div>
                                    <br/>
                                <?php }
                                    if ($rows4 > 0) {
                                    ?>
                                    <div>
                                        <span class="icon-check"></span>
                                        <a class="link" href="certificado_part_evento.php?id=<?php echo $id; ?>" target="_blank">MEUS CERTIFICADOS DE PARTICIPAÇÃO EM EVENTOS</a>
                                        <br/>
                                        Clique para verificar seus certificados.
                                    </div>
                                    <br/>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "rodape.php" ?>
    </body>
</html>