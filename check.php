<?php
 include('./conexao.php');
 $connector = new DbConnector();
 $username = trim(strtolower($_POST['Email']));
 $user = mysql_escape_string($username);
 $query = 'SELECT email FROM pessoa WHERE email = '.$user.' LIMIT 1';
 $result = $connector->query($query); $num = mysql_num_rows($result); echo $num; mysql_close();

