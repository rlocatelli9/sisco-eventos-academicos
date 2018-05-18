<?php
header('Content-type: text/html; charset=UTF-8', TRUE);
ini_set('default_charset', 'UTF-8');
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
$id = $_GET['id'];
require'conexao.php';
$query = mysql_query("SELECT * FROM evento WHERE idevento=" . $id)or die(mysql_error());
$resultado = mysql_fetch_array($query);
?>
<div style="text-align: center; background-color: red; color: white"><span style="font-size: 10px">[Informações sobre o Evento <?php echo utf8_encode($resultado['titulo']); ?>]
        <a href="javascript:func()" onclick="fechar()"><i class="icon-remove" title="Fechar"></i></a></span></div>
<br/>
<form name="alterarevento" method="POST" action="confirmaevento.php">
    <input style="width: 100%" type="hidden" name="id" value="<?php echo $resultado['idevento']; ?>">
    <table  style=" width: 550px; height: 280px;" border=1 align="center">
        <tbody>
            <tr>
                <td><label>Titulo</label></td>
                <td align="left"><input style="width: 100%" name="titulo" value="<?php echo utf8_encode($resultado['titulo']); ?>" size="30" onkeyup="toUpper(this);"></td>
            </tr>
            <tr>
                <td><label>Descrição</label></td>
                <td><textarea name="descricao" rows="4" style="width: 100%"><?php echo utf8_encode($resultado['descricao']); ?></textarea></td>
            </tr>
            <tr>
                <td><label>Início</label></td>
                <td align="left"><input style="width: 100%" name="datainicio" value="<?php echo utf8_encode($resultado['periodoon']); ?>"></td>
            </tr>
            <tr>
                <td><label>Término</label></td>
                <td align="left"><input style="width: 100%" name="datafim" value="<?php echo utf8_encode($resultado['periodooff']); ?>"></td>
            </tr>
            <tr>
                <td><label>Carga horária</label></td>
                <td align="left"><input style="width: 100%" name="cargahoraria"  value="<?php echo utf8_encode($resultado['cargahoraria']); ?>"></td>
            </tr>
        </tbody>
    </table>

    <button type="submit" id="edita" name="edita" class="btn btn-success">Salvar alteração</button>
</form>
