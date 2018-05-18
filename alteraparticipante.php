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
        <title>SISCO Eventos Acadêmicos</title>
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
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img src="img/background_cabecalho.jpg" ></a></div>
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
                                <div id="conteudo">
                                    <form name="informacoes" id="info1" method="POST">
                                        <table class="tabela_01">
                                            <tbody><tr>
                                                    <td>
                                                        <?php include './bar.php'; ?>
                                                        <br>
                                                        <?php
                                                        $id = $_SESSION['UsuarioID'];
                                                        $select = mysql_query("SELECT * FROM pessoa WHERE idpessoa=$id");
                                                        $row = mysql_fetch_array($select);
                                                        ?>
                                                        <input type="hidden" name="idpessoa" value="<?php echo $row['idpessoa']; ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="titulo"><span class="titulo_verde">MINHAS INFORMAÇÕES PESSOAIS</span></div><br><br></td>
                                                </tr>	<tr>
                                                    <td>
                                                        <table class="tabela_02">

                                                            <tbody><tr>
                                                                    <td colspan="2"><strong>INFORMAÇÕES PESSOAIS:</strong></td>
                                                                </tr>
                                                                <?php if ($_SESSION['UsuarioID'] == 3) { ?>

                                                                    <tr>
                                                                        <td class="fundotd" align="right">E-mail:</td>
                                                                        <td class="fundotd td_com_input"><input  name="email" id="email" class="form-control" value="<?php echo $row['email']; ?>" type="text"  onblur="habilita_a();"></td>
                                                                    </tr>
                                                                <?php } else { ?>
                                                                    <tr>
                                                                        <td class="fundotd" align="right">E-mail:</td>
                                                                        <td class="fundotd td_com_input"><input  class="form-control" value="<?php echo $row['email']; ?>" type="text" disabled="disabled"></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td class="fundotd" align="right">*Nome completo:</td>
                                                                    <td class="fundotd td_com_input"><input class="form-control" name="nomecompleto" id="2" value="<?php echo utf8_encode($row['nome']); ?>" maxlength="100" type="text"></td>
                                                                </tr>
                                                                <?php if ($_SESSION['UsuarioID'] == 3) { ?>
                                                                    <tr>
                                                                        <td class="fundotd" align="right">*CPF:</td>
                                                                        <td class="fundotd"><input name="cpf" id="8" value="<?php echo $row['cpf']; ?>" size="11" maxlength="11" class="formulario" type="text">
                                                                        </td>
                                                                    </tr>
                                                                <?php } else { ?>
                                                                    <tr>
                                                                        <td class="fundotd" align="right">*CPF:</td>
                                                                        <td class="fundotd"><input name="cpf" id="8" value="<?php echo $row['cpf']; ?>" disabled="disabled" size="11" maxlength="11" class="formulario" type="text">
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>

                                                                <tr>
                                                                    <td class="fundotd" align="right">*Data de Nascimento:</td>
                                                                    <?php
//                                                                    $dtbanco = $row['data_nasc'];
//
//                                                                    function exibirData($data) {
//                                                                        $rData = explode("-", $data);
//                                                                        $rData = $rData[2] . '-' . $rData[1] . '-' . $rData[0];
//                                                                        return $rData;
//                                                                    }
//
//                                                                    $dtFormatada = exibirData($dtbanco);
//                                                                    echo $dtFormatada;
//                                                                    
                                                                    ?>
                                                                    <td class="fundotd td_com_input"><input name="datanascimento" id="12" value="<?php echo $row['data_nasc']; ?>" maxlength="10" type="date"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">Cidade:</td>
                                                                    <td class="fundotd">
                                                                        <input class="form-control" name="cidade" id="27" value="<?php echo utf8_encode($row['cidade']); ?>" size="100" maxlength="100" class="formulario" type="text">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">Estado:</td>
                                                                    <td class="fundotd">
                                                                        <input name="estado" id="27" value="<?php echo $row['estado']; ?>" size="2" maxlength="2" class="formulario" type="text">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">Tel. celular:</td>
                                                                    <td class="fundotd">
                                                                        <input name="telCel" id="27" value="<?php echo $row['telefone']; ?>" size="11" maxlength="11" class="formulario" type="text">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="right">A qual instituição pertence?</td>
                                                                    <td class="fundotd td_com_input">
                                                                        <input class="form-control" name="instituicao" id="34" value="<?php echo utf8_encode($row['Nome_Instituicao']); ?>" maxlength="80" class="formulario formulario_input" type="text"></td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="2" class="fundotd" align="center">
                                                                        <input type="hidden" name="acao" value="editar" />
                                                                        <button type="submit" class="btn btn-danger" name="editar" title="Editar Cadastro">Editar Cadastro</button></td>
                                                                                            <!--<input name="button" id="button" value="Alterar Dados" class="btn btn-danger" onclick="javascript:VerificaTudo();" type="button"><br>-->
                                                                </tr>

                                                            </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>
                                    </form>
                                </div>
                                <div align="left">
                                    <a href="javascript:fun()" class="btn btn-success" onclick="window.history.back()"><span><i class="icon-backward"></i> VOLTAR</span></a>
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
