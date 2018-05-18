<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
include 'conexao.php';
// A sess�o precisa ser iniciada em cada p�gina diferente
if (!isset($_SESSION)) {
    session_start();
}
// Verifica se não há a vari�vel da sess�o que identifica o usu�rio
if (!isset($_SESSION['UsuarioNome'])) {
    // Destr�i a sess�o por seguran�a
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: negado.php");
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="logo_Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda" >
                                    <?php include "menu.php" ?>
                                </div>
                            </div>
                            <div class="span9">
                                <br><br>
                                <table class="table" >
                                    <thead>
                                    <th>
                                        Olá, <?php echo $_SESSION['UsuarioNome']; ?>!
                                        <a class="btn" href="logout.php"><i class="icon-off"></i></a>
                                    </th>
                                    </thead>
                                    <tr>
                                        <td> <div align="center"><a class="btn" href="consultarparticipante.php"><i class="icon-search"></i></a></div></td>
                                        <td> <div align="center"><a class="btn" href="consultarparticipante.php"><i class="icon-edit"></i></a></div></td>
                                        <td> <div align="center"><a class="btn" href="consultarparticipante.php"><i class="icon-remove"></i></a></div></td>
                                    </tr>
                                    <tr>
                                        <td> <div align="center">Consultar inscrição</div></td>
                                        <td> <div align="center">Alterar inscrição</div></td>
                                        <td> <div align="center">Excluir inscrição</div></td>
                                    </tr>
                                    <tr>
                                        <td> <div align="center"><a class="btn" href="cadastroinstrutor.php"><i class="icon-plus"></i></a></div></td>
                                        <td> <div align="center"><a class="btn" href="cadastropalestrante.php"><i class="icon-plus"></i></a></div></td>
                                        <td> <div align="center"><a class="btn" href="cadastropalestra.php"><i class="icon-plus"></i></a></div></td>
                                        <td> <div align="center"><a class="btn" href="cadastrominicurso.php"><i class="icon-plus"></i></a></div></td>
                                    </tr>
                                    <tr>
                                        <td> <div align="center">Adicionar Instrutor</div></td>
                                    </tr>
                                    <tr>
                                        <td> <div align="center">Adicionar Palestrante</div></td>
                                    </tr>
                                    <tr>
                                        <td> <div align="center">Adicionar Palestra</div></td>
                                    </tr>
                                    <tr>
                                        <td> <div align="center">Adicionar Mini Curso</div></td>
                                    </tr>
                                </table>
                                <br>
                                <a href='javascript:history.back()'>Voltar para página anterior</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "rodape.php" ?>
            </div>
        </div>
    </body>
</html>