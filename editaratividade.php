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
<?php
if (isset($_POST['acao']) && $_POST['acao'] == 'editar') {
    require ('confirmatividade.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Edição de Atividade</title>
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
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img src="img/background_cabecalho.jpg" alt="logo_Ifes" ></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <?php include "./menu_usuario.php" ?>	
                            </div>
                            <div class="span9">
                                <div id="conteudo">
                                    <form name="informacoes" id="info1" method="POST">
                                        <table class="tabela_01">
                                            <tbody><tr>
                                                    <td>
                                                        <?php include './bar.php'; ?>
                                                        <br>
                                                        <?php
                                                        $idE = filter_input(INPUT_GET,'id');
                                                        $select = mysql_query("SELECT * FROM atividades WHERE idatividades=$idE");
                                                        $linha=  mysql_fetch_array($select);
                                                        ?>
                                                        <input type="hidden" name="id" value="<?php echo $linha['idatividades']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="titulo"><span class="titulo_verde">EDITAR ATIVIDADE</span></div><br><br></td>
                                                </tr>	<tr>
                                                    <td>
                                                        <table class="tabela_02">
                                                            <tbody><tr>
                                                                    <td colspan="2"><strong>INFORMAÇÕES:</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">*Titulo:</td>
                                                                    <td class="fundotd td_com_input"><input name="titulo" id="2" value="<?php echo utf8_encode($linha['titulo']); ?>" type="text" onkeyup="toUpper(this);"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">*Descricao(200 caracteres):</td>
                                                                    <td class="fundotd td_com_input"><input name="descricao" id="3" value="<?php echo utf8_encode($linha['descricao_atividade']); ?>" maxlength="150" type="text"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">*Data:</td>
                                                                    <td class="fundotd td_com_input"><input name="data" id="4" value="<?php echo $linha['data']; ?>" maxlength="10" type="text"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">*Início:</td>
                                                                    <td class="fundotd td_com_input"><input name="inicio" id="5" value="<?php echo $linha['inicio']; ?>" maxlength="10" type="text"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">*Fim:</td>
                                                                    <td class="fundotd td_com_input"><input name="fim" id="6" value="<?php echo $linha['fim']; ?>" maxlength="10" type="text"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">*Carga Horária:</td>
                                                                    <td class="fundotd td_com_input"><input name="cargahoraria" id="7" value="<?php echo $linha['cargahoraria']; ?>" type="text"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="fundotd" align="center">
                                                                        <input type="hidden" name="acao" value="editar" />
                                                                        <button type="submit" class="btn btn-danger" name="editar" title="Editar Atividade">Editar Atividade</button></td>                                                                         
                                                                </tr>
                                                            </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    </form>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <?php include "rodape.php" ?>
    </body>
</html>