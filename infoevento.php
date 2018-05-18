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
        <script language="Javascript">
            function confirmacao_atividade(id) {
                var resposta = confirm("Deseja remover esse registro?");

                if (resposta) {
                    window.location.href = "excluiratividade.php?id=" + id;
                } else {
                    return false;
                }
            }
        </script>
        <script language="Javascript">
            function confirmacao_ministrante(id) {
                var resposta = confirm("Deseja remover esse registro?");

                if (resposta) {
                    window.location.href = "excluirministrante.php?id=" + id;
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
                                <?php
                                $idE = filter_input(INPUT_GET, 'id');
                                $select = mysql_query("SELECT * FROM evento WHERE idevento=$idE");
                                $linha = mysql_fetch_array($select);
                                ?>
                                <?php $idevento = $linha['idevento']; ?>
                                <span class="titulo_verde"><?php echo utf8_encode($linha['titulo']); ?></span>
                                <div>
                                    <input type="hidden" name="idevento" id="input2" value="<?php echo $idevento; ?>">
                                    <span style="font-size: 10px"><a href="editarevento.php?id=<?php echo $idevento; ?>">(Editar Informações) <i class="icon-edit"></i></a></span>
                                </div>
                                <div>
                                    <?php echo utf8_encode($linha['descricao']); ?>
                                </div>
                                <div class="titulo"></div>
                                <br/>
                                <div>
                                    <span class="subtitulo">Atividades Cadastradas:</span>
                                    <br/>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr class="info">
                                                <td colspan="7"><div class="negrito" align="center"><strong>ATIVIDADES</strong></div></td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td width="100"><strong>Descrição</strong></td>
                                                <td width="200"><strong>Titulo</strong></td>
                                                <td><strong>Data</strong></td>
                                                <td><strong>Hora</strong></td>
                                                <td><strong></strong></td>
                                                <td><strong></strong></td>
                                                <td><strong></strong></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                include 'conexao.php';
                                                // Faz o Select pegando o registro inicial até a quantidade de registros para página
                                                $sql_atividade = mysql_query("SELECT atividades.idatividades, atividades.titulo, atividades.data, atividades.inicio, tipo_atividade.descricao FROM atividades "
                                                        . "INNER JOIN tipo_atividade ON tipo_atividade.idtipo=atividades.tipo_atividade_idtipo "
                                                        . "WHERE ativo=1 AND evento_idevento=$idE ORDER BY data DESC"); //                                          
                                                while ($array_atividade = mysql_fetch_array($sql_atividade)) {
                                                    ?>                                                      
                                                    <td><font color="#000000"><?php echo utf8_encode($array_atividade['descricao']); ?></font></td>
                                                    <td><font color="#000000"><strong><?php echo utf8_encode($array_atividade['titulo']); ?></strong></font></td>
                                                    <td><font color="#000000"><?php echo $array_atividade['data']; ?></font></td>
                                                    <td><font color="#000000"><?php echo $array_atividade['inicio']; ?></font></td>
                                                    <td>
                                                        <div align="center">

                                                            <span style="font-size: 10px"><a href="exibiratividade.php?id=<?php echo $array_atividade['idatividades']; ?>" target="_blank"><i class="icon-file" title="Ficha em PDF"></i></a></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="center">

                                                            <span style="font-size: 10px"><a href="editaratividade.php?id=<?php echo $array_atividade['idatividades']; ?>"><i class="icon-edit" title="Editar"></i></a></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="javascript:func()" onclick="confirmacao_atividade(<?php echo $array_atividade['idatividades']; ?>)"><i class="icon-trash" title="Ecluir"></i></a></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                                <div>
                                    <form name="form3" method="GET" action="">
                                        <span class="icon-check"></span>
                                        <a class="link" href="cadastroatividade.php">ADICIONAR ATIVIDADE</a>
                                        <br/>
                                        Clique para conferir, editar ou excluir as informações.
                                        <input type="hidden" name="id3" id="input4" value="<?php echo $id; ?>">
                                    </form>
                                </div>
                                <div class="titulo"></div>
                                <div>
                                    <span class="subtitulo">Ministrantes Cadastrados:</span>
                                    <br/>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr class="info">
                                                <td colspan="6"><div class="negrito" align="center"><strong>MINISTRANTES</strong></div></td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td><strong>Função</strong></td>
                                                <td><strong>Ministrante</strong></td>
                                                <td><strong>Descrição</strong></td>
                                                <td><strong></strong></td>
                                                <td><strong></strong></td>
                                                <td><strong></strong></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                include 'conexao.php';
                                                // Faz o Select pegando o registro inicial até a quantidade de registros para página
                                                //$sql_ministrante = mysql_query("SELECT * FROM ministrantes ORDER BY idministrantes ASC");
                                                $sql_ministrante = mysql_query("SELECT funcao_ministrante.descricao_fministrante, pessoa.nome, ministrantes.idministrantes, ministrantes.descricao_resumida, atividades.descricao_atividade FROM ministrantes "
                                                        . "INNER JOIN funcao_ministrante ON funcao_ministrante.idfuncao_ministrante = ministrantes.funcao_ministrante_idfuncao_ministrante "
                                                        . "INNER JOIN pessoa ON pessoa.idpessoa = ministrantes.Pessoa_idpessoa "
                                                        . "INNER JOIN atividades ON atividades.idatividades = ministrantes.atividades_idatividades "
                                                        . "WHERE atividades_evento_idevento=$idE");
                                                while ($array_ministrante = mysql_fetch_array($sql_ministrante)) {
                                                    ?>                                                   
                                                    <td><font color="#000000"><?php echo utf8_encode($array_ministrante['descricao_fministrante']); ?></font></td>
                                                    <td><font color="#000000"><strong><?php echo utf8_encode($array_ministrante['nome']); ?></strong></font></td>
                                                    <td><font color="#000000"><?php echo utf8_encode($array_ministrante['descricao_resumida']); ?></font></td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="exibirministrante.php?id=<?php echo $array_ministrante['idministrantes']; ?>" target="_blank"><i class="icon-file" title="Ficha em PDF"></i></a></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="editarministrante.php?id=<?php echo $array_ministrante['idministrantes']; ?>"><i class="icon-edit" title="Editar"></i></a></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="javascript:func()" onclick="confirmacao_ministrante(<?php echo $array_ministrante['idministrantes']; ?>)"><i class="icon-trash" title="Excluir"></i></a></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br/>
                                <div>
                                    <form name="form4" method="GET" action="">
                                        <span class="icon-check"></span>
                                        <a class="link" href="cadastroministrante.php">ADICIONAR MINISTRANTE</a>
                                        <br/>
                                        Clique para conferir, editar ou excluir as informações.
                                        <input type="hidden" name="id4" id="input5" value="<?php echo $id; ?>">
                                    </form>
                                </div>
                                <div class="titulo"></div>
                                <span class="subtitulo">Comissões:</span>
                                <div align="center">
                                    <br/>
                                    <span class="icon-eye-open"></span>
                                    <a class="link" href="mostracomissao.php?id=<?php echo $idevento; ?>">EXIBIR COMISSÃO DO EVENTO</a>

                                    <span class="icon-check"></span>
                                    <a class="link" href="cadastrocomissao.php">ADICIONAR COMISSÃO</a>
                                    <br/>
                                    Clique para conferir, editar ou excluir as informções.

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