<?php
//envio o charset para evitar problemas
header("Content-Type: text/html; charset=UTF-8");
$con = mysql_connect('localhost', 'root', 'root');//faço a conexão com o banco
mysql_select_db('banco_sisco', $con);//seleciono a tabela no banco
$sql = "
SELECT * FROM `pessoa`
WHERE `email` = '{$_POST['Email']}' ";//monto a query
$q = mysql_query( $sql );//executo a query
if (mysql_num_rows($q) > 0) {//se retornar algum resultado
    echo 'Email já existe!';
}