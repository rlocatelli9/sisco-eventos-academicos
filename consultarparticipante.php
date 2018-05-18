<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');

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
        <script src="js/validacao.js"></script>
        <script language="Javascript">
            function confirmacao(id) {
                var resposta = confirm("Deseja remover esse registro?");

                if (resposta) {
                    window.location.href = "excluirparticipante.php?identify=" + id;
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
                                <div id="doc-esquerda" >
                                    <?php include "./menu_usuario.php" ?>
                                </div>
                            </div>
                            <div class="span9">
                                <br><br>
                                <table class="table table-condensed">
                                    <tbody>
                                        <tr class="info">
                                            <td colspan="5"><div class="negrito" align="center"><strong>Participantes Cadastrados</strong></div></td>
                                        </tr>
                                        <tr style="text-align: center">
                                            <td width="163"><strong>Nome</strong></td>
                                            <td width="383"><strong>Email</strong></td>
                                            <td width="383"><strong>Origem</strong></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <?php
                                            include 'conexao.php';
                                            mysql_query("SET NAMES 'utf8'");
                                            mysql_query('SET character_set_connection=utf8');
                                            mysql_query('SET character_set_client=utf8');
                                            mysql_query('SET character_set_results=utf8');
//######### INICIO Pagina��o
                                            $numreg = 6; // Quantos registros por p�gina vai ser mostrado
                                            if (!isset($pg)) {
                                                $pg = 0;
                                            }
                                            $inicial = filter_input(INPUT_GET, 'pg') * $numreg;
//######### FIM dados Pagina��o
                                            // Faz o Select pegando o registro inicial até a quantidade de registros para página
                                            $sql = mysql_query("SELECT * FROM pessoa LIMIT " . $inicial . "," . $numreg);
                                            // Serve para contar quantos registros você tem na sua tabela para fazer a paginação
                                            $sql_conta = mysql_query("SELECT * FROM pessoa");
                                            $quantreg = mysql_num_rows($sql_conta); // Quantidade de registros pra paginação
                                            include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
                                            echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
                                            while ($registro = mysql_fetch_array($sql)) {
                                                ?>  
                                                <td><font color="#000000"><?php echo $registro['nome']; ?></font></td>
                                                <td><font color="#000000"><?php echo $registro['email']; ?></font></td>
                                                <td><font color="#000000"><?php echo $registro['instituicaoorigem']; ?></font></td>
                                                <td>
                                                    <form name="form1" method="post" action="editausuario.php">
                                                        <div align="center">
                                                            <input type="submit" name="alterar" id="alterar" class="btn btn-warning" value="Alterar">
                                                            <input type="hidden" name="recebeid" id="recebeid" value="<?php echo $registro['idpessoa']; ?>">
                                                        </div>
                                                    </form></td>
                                                <td>
                                                    <form name="form2" method="post" action="excluirparticipante.php">
                                                        <div align="center">
                                                            <!--<input type="submit" name="excluir" id="excluir" class="btn btn-danger" value="Excluir">-->
                                                            <a name="excluir" href="javascript:func()" class="btn btn-danger" onclick="confirmacao(<?php echo $registro['idpessoa']; ?>)">Excluir</a>
                                                            <input type="hidden" name="recebeid2" id="recebeid2" value="<?php echo $registro['idpessoa']; ?>">
                                                        </div>
                                                    </form></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div align="left">
                                    <a href="javascript:func()" class="btn btn-success" onclick="history.back()"><span><i class="icon-backward"></i> Voltar</span></a>
                                </div>
                                <br/>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "rodape.php" ?>
    </body>
</html>