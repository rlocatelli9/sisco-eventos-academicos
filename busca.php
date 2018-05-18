<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
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
// Conecte-se ao MySQL antes desse ponto
include './conexao.php';
$select = mysql_query("SELECT * FROM evento WHERE idevento=$id");
$linha = mysql_fetch_array($select);
// Verifica se foi feita alguma busca
// Caso contrario, redireciona o visitante pra home
if (!isset($_GET['consulta'])) {
    header("Location: ./index.php");
    exit;
}
// Salva o que foi buscado em uma variável
$busca = mysql_real_escape_string($_GET['consulta']);
// ============================================
// Monta outra consulta MySQL para a busca
$sql = "SELECT * FROM atividades WHERE (ativo = 1) AND ((titulo LIKE '%" . $busca . "%') OR ('%" . $busca . "%')) ORDER BY titulo DESC";
// Executa a consulta
$query = mysql_query($sql);
// ============================================
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Eventos em Destaque</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
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
                                <?php $idevento = $linha['idevento']; ?>
                                <span class="titulo_verde"><?php echo utf8_encode($linha['titulo']); ?></span>
                                <div>
                                    <input type="hidden" name="idevento" id="input2" value="<?php echo $idevento; ?>">
                                    <span style="font-size: 10px"><a href="editarevento.php?id=<?php echo $idevento; ?>">(Editar Informações) <i class="icon-edit"></i></a></span>
                                </div>
                                <div>
                                    <?php echo $linha['descricao']; ?>
                                </div>
                                <div class="titulo"></div>
                                <br/>
                                <div>
                                    <span class="subtitulo">Atividades Cadastradas:</span>
                                    <br/>
                                    <form method="GET" action="busca.php">
                                        <div class="form-group">
                                            <label for="consulta">Buscar Atividade:</label>
                                            <input id="consulta" name="consulta" type="text" class="form-control" maxlength="25" placeholder="Pesquisar atividade" title="Pesquisar atividade"/>

                                            <input type="submit" value="OK" />
                                        </div>
                                    </form>
                                    <table class="table table-condensed">
                                        <tbody>
                                            <tr class="info">
                                                <td colspan="6"><div class="negrito" align="center"><strong>ATIVIDADES</strong></div></td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td width="100"><strong>Descrição</strong></td>
                                                <td width="200"><strong>Titulo</strong></td>
                                                <td><strong>Data</strong></td>
                                                <td><strong>Hora</strong></td>
                                                <td><strong></strong></td>
                                                <td><strong></strong></td>
                                            </tr>
                                            <tr>
                                                <?php
                                                include 'conexao.php';

                                                // Começa a exibição dos resultados
                                                echo "<ul>";
                                                while ($resultado = mysql_fetch_assoc($query)) {
                                                    $titulo = utf8_encode($resultado['titulo']);
                                                    $texto = utf8_encode($resultado['descricao']);
                                                    $link = 'confirma_presenca_atividade.php?id=' . $resultado['idatividades'];
                                                    echo "<li>";
                                                    echo "<a href='{$link}'>";
                                                    echo "<h3>{$titulo}</h3>";
                                                    echo "<p>{$texto}</p>";
                                                    echo "</a>";
                                                    echo "</li>";
                                                }
                                                echo "</ul>";
// Faz o Select pegando o registro inicial até a quantidade de registros para página
                                                $sql_atividade = mysql_query("SELECT atividades.idatividades, atividades.titulo, atividades.data, atividades.inicio, tipo_atividade.descricao FROM atividades "
                                                        . "INNER JOIN tipo_atividade ON tipo_atividade.idtipo=atividades.tipo_atividade_idtipo "
                                                        . "WHERE ativo=1 AND evento_idevento=$id ORDER BY data DESC");                                        
                                                while ($array_atividade = mysql_fetch_array($sql_atividade)) {
                                                    ?>                                                      
                                                    <td><font color="#000000"><?php echo utf8_encode($array_atividade['descricao']); ?></font></td>
                                                    <td><font color="#000000"><strong><?php echo utf8_encode($array_atividade['titulo']); ?></strong></font></td>
                                                    <td><font color="#000000"><?php
                                                $data = new DateTime($array_atividade['data']);
                                                echo $data->format("d-m-Y");
                                                    ?></font></td>
                                                    <td><font color="#000000"><?php echo $array_atividade['inicio']; ?></font></td>
                                                    <td>
                                                        <div align="center">
                                                            <?php $idatividade = $array_atividade['idatividades']; ?>
                                                            <span style="font-size: 10px"><a href="editaratividade.php?id=<?php echo $idatividade; ?>"><i class="icon-list-alt" title="Lista de Presença"></i></a></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <span style="font-size: 10px"><a href="editaratividade.php?id=<?php echo $idatividade; ?>"><i class="icon-check" title="Confirmar Presença"></i></a></span>
                                                        </div>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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