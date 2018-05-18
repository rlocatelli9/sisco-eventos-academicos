<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
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
// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante pra home
$id = (isset($_GET['id']) ? $_GET['id'] : NULL);
if ($id == NULL) {

    echo 'Não deu para pegar o ID.';
    exit();
}
include './conexao.php';

$idE = filter_input(INPUT_GET, 'later');
$select = mysql_query("SELECT * FROM atividades WHERE idatividades=$id");
$linha = mysql_fetch_array($select);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Confirmar Presença</title>
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
                                <?php $idatividades = $linha['idatividades']; ?>
                                <span class="titulo_verde"><?php echo utf8_encode($linha['titulo']); ?></span>
                                <div>
                                    <input type="hidden" name="idatividade" id="input2" value="<?php echo $idatividades; ?>">
                                    <span style="font-size: 10px"><a href="editaratividade.php?id=<?php echo $idatividades; ?>">(Editar Informações) <i class="icon-edit"></i></a></span>
                                </div>
                                <div>
                                    <?php echo utf8_encode($linha['descricao_atividade']); ?>
                                </div>
                                <div class="titulo"></div>
                                <br/>
                                <div>
                                    <span class="subtitulo">Participantes Cadastrados:</span>
                                    <br/>
                                    <form name="confirma_presenca" method="POST" action="confirmar_presenca.php">
                                        <table class="table table-condensed">
                                            <tbody>
                                                <tr class="info">
                                                    <td colspan="4"><div class="negrito" align="center"><strong>PARTICIPANTES</strong></div></td>
                                                </tr>
                                                <tr style="text-align: center">
                                                    <td width="300"><strong>Nome</strong></td>
                                                    <td width="300"><strong>Email</strong></td>
                                                    <td width="3"><strong>Atividade</strong></td>
                                                    <td width="100"><strong></strong></td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    include 'conexao.php';

// Faz o Select pegando o registro inicial até a quantidade de registros para página
                                                    $sql_atividade = mysql_query("SELECT participacao.idparticipante, participacao.presenca, atividades.titulo, atividades.inicio, pessoa.idpessoa, pessoa.nome, pessoa.email FROM participacao "
                                                            . "INNER JOIN atividades ON atividades.idatividades=participacao.atividades_idatividades "
                                                            . "INNER JOIN pessoa ON pessoa.idpessoa=participacao.Pessoa_idpessoa "
                                                            . "WHERE participacao.atividades_idatividades=$id AND participacao.presenca=0;"); //
                                                    $cquant = mysql_num_rows($sql_atividade);
                                                    if ($cquant == 0) {
                                                        echo '<script>alert("Não há participações para confirmar nesta atividade.")</script>';
                                                        echo 'Não há participação para confirmar!';

//echo "<script>window.location.href='evento.php'</script>";
                                                    }
                                                    while ($array_atividade = mysql_fetch_array($sql_atividade)) {
                                                        ?>                                                      
                                                        <td><font color="#000000"><?php echo utf8_encode($array_atividade['nome']); ?></font></td>
                                                        <td><font color="#000000"><strong><?php echo utf8_encode($array_atividade['email']); ?></strong></font></td>
                                                        <td><font color="#000000"><?php echo utf8_encode($array_atividade['titulo']); ?></font></td>
                                                        <td>
                                                            <div id="check" align="center">
                                                                <?php // $idparticipacao = $array_atividade['idparticipante']; ?>
                                                                <input type="checkbox" checked="checked" name="presente[]" value="<?php echo $array_atividade['idparticipante']; ?>"/>
                                                                <input type="text" name="idpessoa[]" value="<?php echo $array_atividade['idpessoa']; ?>"/>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php if ($cquant > 0) { ?>
                                            <div align="right"><button type="submit" class="btn btn-success" name="enviar" title="Confirmar os presentes na atividade">Confirmar Presença</button></div>
                                        <?php } else { ?>
                                            <div align="right"><button type="submit" class="btn btn-success" name="enviar" disabled="disabled">Confirmar Presença</button></div>
                                        <?php } ?>
                                    </form>
                                    <div align="left">
                                        <form name="voltar" method="POST" action="evento.php">
                                            <input type="hidden" name="recebeid" id="id" value="<?php echo $idE; ?>">
                                            <button type="submit" name="voltar" class="btn btn-success" title="Voltar página"><span class="icon-backward"></span> VOLTAR</button>
                                        </form>
                                        <br/>
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
        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>