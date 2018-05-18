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
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Sisco Eventos - Tela participante</title>
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
        <div class="container" >
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
                                <span class="titulo_verde">Trabalhos enviados</span>
                                <span></span>
                                <div class="form-group">
                                        <?php
                                        #chama o arquivo de configura��o com o banco
                                        require 'conexao.php';

                                        #seleciona os dados da tabela produto
                                        $pesq = mysql_query("SELECT idevento, titulo FROM evento ORDER BY titulo ASC;");


                                        # abaixo montamos um formul�rio em html
                                        # e preenchemos o select com dados
                                        ?>
                                        <label for="InputTipo">Selecione o Evento cujo tenha trabalho enviado</label>
                                        <br/>
                                        <select id="funcao" name="evento">
                                            <option>Selecione...</option>

                                            <?php while ($funcao = mysql_fetch_array($pesq)) { ?>
                                                <option value="<?php echo $funcao['idevento'] ?>"><?php echo utf8_encode($funcao['titulo']); ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                <table class="table table-condensed">
                                        <tbody>
                                            <tr class="info">
                                                <td colspan="6"><div class="negrito" align="center"><strong>COMISSÃO</strong></div></td>
                                            </tr>
                                            <tr style="text-align: center">
                                                <td><strong>Evento Destinado</strong></td>
                                                <td><strong>Título</strong></td>
                                                <td><strong>Status</strong></td>
                                            </tr>
                                            <tr>
                                                    <td><font color="#000000"><?php echo $array_comissao['portaria']; ?></font></td>
                                                    <td><font color="#000000"><strong><?php echo utf8_encode($array_comissao['descricao_comissao']); ?></strong></font></td>
                                                    <td><font color="#000000"><strong><?php echo utf8_encode($array_comissao['nome']); ?></strong></font></td>
                                                    
                                            </tr>
                                        </tbody>
                                    </table>
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
