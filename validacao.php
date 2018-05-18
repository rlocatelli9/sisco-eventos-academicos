<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda">
                                    <?php include "menu.php" ?>
                                </div>
                            </div>
                            <div class="span9">
                                <?php
//Verifica se houve POST e se o usu�rio ou a senha vazio(s)
                                if (!empty($_POST) AND ( empty($_POST['email']) OR empty($_POST['senha']))) {
                                    header("Location: index.php");
                                    exit;
                                } else {
// Tenta se conectar ao servidor MySQL
                                    mysql_connect('localhost', 'root', 'root') or trigger_error(mysql_error("é preciso conectar ao Servidor."));
// Tenta se conectar a um banco de dados MySQL
                                    mysql_select_db('banco_sisco') or trigger_error(mysql_error("é preciso conectar ao Banco."));
                                    $email = mysql_real_escape_string($_POST['email']);
                                    $senha = mysql_real_escape_string($_POST['senha']);
// Valida o usu�rio/senha digitados
                                    $sql = "SELECT idpessoa, nome FROM pessoa WHERE (email = '" . $email . "') AND (senha = '" . $senha . "') AND (ativo = 1) LIMIT 1";
                                    $query = mysql_query($sql) or die(mysql_error());
                                }
                                if (mysql_num_rows($query) != 1) {
                                    // Mensagem de erro quando os dados s�o inv�lidos e/ou o usu�rio n�o foi encontrado
                                    echo "<script>alert('Login inválido!')</script>";
                                    echo "<script>window.location.href='index.php'</script>";
                                    exit;
                                } else {
// Salva os dados encontados na vari�vel $resultado
                                    $resultado = mysql_fetch_assoc($query);
                                }
// Se a sess�o n�o existir, inicia uma
                                if (!isset($_SESSION)) {
                                    session_start();
                                }
                                if ($resultado['idpessoa'] == 3) {
// Salva os dados encontrados na sess�o
                                    $_SESSION['UsuarioID'] = $resultado['idpessoa'];
                                    $_SESSION['UsuarioNome'] = $resultado['nome'];
                                    // Redireciona o visitante
                                    header("Location: administrador.php");
                                    exit;
                                } else {
                                    $_SESSION['UsuarioID'] = $resultado['idpessoa'];
                                    $_SESSION['UsuarioNome'] = $resultado['nome'];
                                    // Redireciona o visitante
                                    header("Location: participante.php");
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include "rodape.php" ?>
    </body>
</html>