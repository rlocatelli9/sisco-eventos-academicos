<?php

include 'conexao.php';

$query = "SELECT * FROM pessoa";
$executar_query = mysql_query($query);
$contar = mysql_num_rows($executar_query);

for ($i = 0; $i < 1; $i++) {
    $html[$i] = "";
    $html[$i] .= "<table>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td><b>Nome</b></td>";
    $html[$i] .= "<td><b>Email</b></td>";
    $html[$i] .= "<td><b>Sexo</b></td>";
    $html[$i] .= "<td><b>Campi</b></td>";
    $html[$i] .= "</tr>";
    $html[$i] .= "</table>";
}

$i = 1;
while ($ret = mysql_fetch_array($executar_query)) {
    $html[$i] = "";
    $retorno_nome = $ret['nome'];
    $retorno_email = $ret['email'];
    $retorno_sexo = $ret['sexo'];
    $retorno_origem = $ret['instituicaoorigem'];
    $html[$i] .= "<table>";
    $html[$i] .= "<tr>";
    $html[$i] .= "<td>$retorno_nome</td>";
    $html[$i] .= "<td>$retorno_email</td>";
    $html[$i] .= "<td>$retorno_sexo</td>";
    $html[$i] .= "<td>$retorno_origem</td>";
    $html[$i] .= "</tr>";
    $html[$i] .= "</table>";
    $i++;
}

$arquivo = 'nomes.xls';
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-type: application/x-msexcel");
header("Content-Disposition: attachment; filename={$arquivo}");
header("Content-Description: PHP Generated Data");

for ($i = 0; $i <= $contar; $i++) {
    echo $html[$i];
}
exit;

