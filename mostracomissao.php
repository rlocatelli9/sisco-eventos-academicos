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
$id = (isset($_GET['id']) ? $_GET['id'] : NULL);
if ($id == NULL) {

    echo 'Não deu para pegar o ID.';
    exit();
} else {
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
            <script language="Javascript">
                function confirmacao(id) {
                    var resposta = confirm("Deseja remover esse registro?");

                    if (resposta) {
                        window.location.href = "excluircomissao.php?id=" + id;
                    } else {
                        return false;
                    }
                }
            </script>
        </head>
        <body>
            <div class="container">
                <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="logo_Ifes" src="img/background_cabecalho.jpg" ></a></div>
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
                                    <br>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr class="info">
                                                <td colspan="6"><div class="negrito" align="center"><strong>COMISSÃO</strong></div></td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td><strong>Portaria</strong></td>
                                                <td><strong>Descrição</strong></td>
                                                <td><strong>Membro</strong></td>
                                                <td><strong></strong></td>
                                                <td><strong></strong></td>
                                                <td><strong></strong></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                include 'conexao.php';
// Faz o Select pegando o registro inicial até a quantidade de registros para página
                                                $sql_comissao = mysql_query("SELECT comissao.idcomissao, comissao.portaria, comissao.Pessoa_idpessoa, funcao_comissao.idfuncao_comissao, funcao_comissao.descricao_comissao, pessoa.idpessoa, pessoa.nome FROM comissao "
                                                        . "INNER JOIN funcao_comissao ON funcao_comissao.idfuncao_comissao = comissao.funcao_comissao_idfuncao_comissao "
                                                        . "INNER JOIN pessoa ON pessoa.idpessoa = comissao.Pessoa_idpessoa "
                                                        . "WHERE evento_idevento=$id ORDER BY descricao_comissao DESC");
                                                while ($array_comissao = mysql_fetch_array($sql_comissao)) {
                                                    ?>  
                                                    <td><font color="#000000"><?php echo $array_comissao['portaria']; ?></font></td>
                                                    <td><font color="#000000"><strong><?php echo utf8_encode($array_comissao['descricao_comissao']); ?></strong></font></td>
                                                    <td><font color="#000000"><strong><?php echo utf8_encode($array_comissao['nome']); ?></strong></font></td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="exibircomissao.php?id=<?php echo $array_comissao['idfuncao_comissao']; ?>" target="_blank"><i class="icon-file" title="Lista em PDF"></i></a></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="editarcomissao.php?id=<?php echo $array_comissao['idcomissao']; ?>"><i class="icon-edit" title="Editar"></i></a></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="javascript:func()" onclick="confirmacao(<?php echo $array_comissao['idcomissao']; ?>)"><i class="icon-trash" title="Excluir"></i></a></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div align="left">
                                        <a href="infoevento.php?id=<?php echo $id; ?>" class="btn btn-success"><span><i class="icon-backward"></i> VOLTAR</span></a>
                                    </div>
                                    <br/>
                                    <div align="center">
                                        <a href="https://get.adobe.com/br/reader/" target="_blank"><img src="img/get_adobe_reader.gif" alt="download_reader"></a>
                                    </div>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php include "rodape.php" ?>
            <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
            <script src="js/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
        </body>
    </html>
    <?php
}