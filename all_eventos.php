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
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Página de Eventos</title>
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
                    window.location.href = "excluirevento.php?identify=" + id;
                } else {
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda">
                                    <?php include './menu_usuario.php'; ?>
                                </div>
                            </div>
                            <div class="span9">
                                <?php include './bar.php'; ?>
                                <span class="titulo_verde">Área de Eventos</span>
                                <br />
                                <span>Olá <strong><u><?php echo $_SESSION['UsuarioNome']; ?></u></strong>. Você Terá total acesso ao sistema.</span><br/>
                                <span>Segue as opções com as descrições abaixo do link.</span>
                                <span>Clique no evento que deseja gerenciar.</span>
                                <div class="titulo"></div>
                                <br/>
                                <table class="table table-condensed" >
                                    <tbody>
                                        <tr class="info">
                                            <td colspan="7"><div class="negrito" align="center"><strong>Eventos Cadastrados</strong></div></td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td width="150"><strong>Titulo</strong></td>
                                            <td width="400"><strong>Descrição</strong></td>
                                            <td width="150"><strong>Data de Início</strong></td>
                                            <td width="150"><strong>Data de Término</strong></td>

                                        </tr>
                                        <tr>
                                            <?php
                                            include 'conexao.php';
//######### INICIO Paginação
                                            $numreg = 4; // Quantos registros por página vai ser mostrado
                                            if (!isset($pg)) {
                                                $pg = 0;
                                            }
                                            $inicial = filter_input(INPUT_GET, 'pg') * $numreg;

//######### FIM dados Pagina��o
                                            // Faz o Select pegando o registro inicial até a quantidade de registros para página
                                            $sql = mysql_query("SELECT * FROM evento WHERE ativo=1 ORDER BY periodoon DESC LIMIT " . $inicial . "," . $numreg);

                                            // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
                                            $sql_conta = mysql_query("SELECT * FROM evento");

                                            $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação

                                            include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>

                                            echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
//$sql= "SELECT * FROM pessoa ";
//$resultado = mysql_query($sql);

                                            while ($registro = mysql_fetch_array($sql)) {
                                                ?>  
                                                <td><font color="#000000"><strong><?php echo utf8_encode($registro['titulo']); ?></strong></font></td>
                                                <td><font color="#000000"><?php echo utf8_encode(mb_substr($registro['descricao'], 0, 55)); ?></font></td>
                                                <td><font color="#000000"><?php echo $registro['periodoon']; ?></font></td>
                                                <td><font color="#000000"><?php echo $registro['periodooff']; ?></font></td>

                                                <td>
                                                    <form name="form1" method="post" action="evento.php">
                                                        <div align="center">
                                                            <input type="submit" name="alterar" id="alterar" class="btn btn-info" value="Gerenciar">
                                                            <input type="hidden" name="recebeid" id="recebeid" value="<?php echo $registro['idevento']; ?>">
                                                        </div>
                                                    </form></td>
                                                <td>
                                                    <form name="form2">
                                                        <div align="center">
                                                            <?php $idevento = $registro['idevento']; ?>
                                                            <a name="excluir" href="javascript:func()" class="btn btn-danger" onclick="confirmacao(<?php echo $idevento; ?>)">Excluir</a>
                                                            <input type="hidden" name="recebeid2" id="recebeid2" value="<?php echo $idevento; ?>">
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div>
                                    <span class="icon-check"></span>
                                    <a class="link" href="cadastroevento.php">CADASTRAR EVENTO</a>
                                    <br/>
                                    Clique para cadastar evento ao SISCO
                                </div><br/>
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
