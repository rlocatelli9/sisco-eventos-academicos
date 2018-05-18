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
    require ('confirmaministrante.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
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
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img src="img/background_cabecalho.jpg" alt="logo_Ifes"></a></div>
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
                                                        $idE = filter_input(INPUT_GET, 'id');
                                                        $select = mysql_query("SELECT funcao_ministrante.descricao_fministrante, pessoa.nome, "
                                                                . "ministrantes.descricao_resumida, ministrantes.Pessoa_idpessoa, ministrantes.grau_formacao_idgrau_formacao, ministrantes.atividades_idatividades, ministrantes.atividades_evento_idevento, funcao_ministrante_idfuncao_ministrante, "
                                                                . "atividades.descricao_atividade FROM ministrantes "
                                                                . "INNER JOIN funcao_ministrante ON funcao_ministrante.idfuncao_ministrante = ministrantes.funcao_ministrante_idfuncao_ministrante "
                                                                . "INNER JOIN pessoa ON pessoa.idpessoa = ministrantes.Pessoa_idpessoa "
                                                                . "INNER JOIN atividades ON atividades.idatividades = ministrantes.atividades_idatividades "
                                                                . "WHERE idministrantes=$idE");
                                                        $linha = mysql_fetch_array($select);
                                                        ?>
                                                        <input type="hidden" name="id" value="<?php echo $idE ?>">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><div class="titulo"><span class="titulo_verde">EDITAR MINISTRANTE</span></div><br><br></td>
                                                </tr>	<tr>
                                                    <td>
                                                        <table class="tabela_02">
                                                            <tbody><tr>
                                                                    <td><strong>INFORMAÇÕES:</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $buscar = mysql_query("SELECT idpessoa, nome FROM pessoa ORDER BY nome ASC;");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            Ministrante selecionado
                                                                            <select  id="pessoa" name="pessoa">

                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($buscar)) {
                                                                                    if ($funcao['idpessoa'] == $linha['Pessoa_idpessoa']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                <option class="fundotd td_com_input" value="<?= $funcao['idpessoa'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['nome']); ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $busc = mysql_query("SELECT idgrau_formacao, descricao FROM grau_formacao ORDER BY descricao ASC;");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            *Grau de formação
                                                                            <select id="formacao" name="formacao">
                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($busc)) {
                                                                                    if ($funcao['idgrau_formacao'] == $linha['grau_formacao_idgrau_formacao']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                <option class="fundotd td_com_input" value="<?= $funcao['idgrau_formacao'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['descricao']); ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            *Descrição(1000 caracteres):<br/>
                                                                            <textarea class="fundotd td_com_input" name="descricao_resumida" id="3" maxlength="1000" style="width: 100%"><?php echo utf8_encode($linha['descricao_resumida']); ?></textarea>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="titulo" style="width: 100%"></div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $pesq = mysql_query("SELECT idevento, titulo FROM evento ORDER BY titulo ASC;");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            *Evento correspondente:
                                                                            <select id="evento" name="evento">
                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($pesq)) {
                                                                                    if ($funcao['idevento'] == $linha['atividades_evento_idevento']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                <option class="fundotd td_com_input" value="<?= $funcao['idevento'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['titulo']); ?></option>

                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $pesquisa = mysql_query("SELECT * FROM funcao_ministrante ORDER BY descricao_fministrante ASC;");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            *Selecione a função:
                                                                            <select id="funcao" name="funcao">
                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($pesquisa)) {
                                                                                    if ($funcao['idfuncao_ministrante'] == $linha['funcao_ministrante_idfuncao_ministrante']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                <option class="fundotd td_com_input" value="<?= $funcao['idfuncao_ministrante'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['descricao_fministrante']); ?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd"><div class="form-group">
                                                                            <?php
                                                                            #chama o arquivo de configura��o com o banco
                                                                            require 'conexao.php';
                                                                            #seleciona os dados da tabela produto
                                                                            $busca = mysql_query("SELECT * FROM atividades ORDER BY titulo");
                                                                            # abaixo montamos um formul�rio em html
                                                                            # e preenchemos o select com dados
                                                                            ?>
                                                                            *Qual atividade estará relacionada:
                                                                            <select id="atividade" name="atividade">
                                                                                <?php
                                                                                while ($funcao = mysql_fetch_array($busca)) {
                                                                                    if ($funcao['idatividades'] == $linha['atividades_idatividades']) {
                                                                                        $selected = 'selected';
                                                                                    } else {
                                                                                        $selected = '';
                                                                                    }
                                                                                    ?>
                                                                                <option class="fundotd td_com_input" value="<?= $funcao['idatividades'] ?>" <?php echo $selected; ?>><?= utf8_encode($funcao['titulo']); ?></option>

                                                                                <?php } ?>
                                                                            </select>
                                                                        </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="fundotd" align="center">
                                                                        <input type="hidden" name="acao" value="editar" />
                                                                        <button type="submit" class="btn btn-danger" name="editar" title="Editar Ministrante">Editar Ministrante</button></td>                                                                                
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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