<div id="bar">
    <div>Área do(a):</div>
    <div id="nome"><?php echo $_SESSION['UsuarioNome']; ?></div>
    <div id="logout"><?php if ($_SESSION['UsuarioID'] == 3) { ?>
        <a href="administrador.php" class="link">ÁREA DO ADMINISTRADOR</a>
        <?php } else { ?>
            <a href="participante.php" class="link">ÁREA DO(A) USUÁRIO(A)</a>
        <?php } ?> | <a class="link" href="logout.php">SAIR</a></div>
</div>