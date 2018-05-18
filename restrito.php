<?php
// A sess�o precisa ser iniciada em cada p�gina diferente
if (!isset($_SESSION)) {
    session_start();
}
//$nivel_necessario = 2;
// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
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
        <title>Página restrita</title>
    </head>
    <body>
        <h1>Página restrita</h1>
        <p>Olá, <?php echo $_SESSION['UsuarioNome']; ?>! Você está logado como <strong>ADMINISTRADOR</strong></p>
        <form method="POST" action="logout.php">
            <br>
            <input type="submit" class="btn btn-warnig" value="sair">
        </form>
    </body>
</html>