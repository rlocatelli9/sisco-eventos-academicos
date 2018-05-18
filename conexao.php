<?php
    date_default_timezone_set('UTC');
	$host = "localhost";
	$username = "root";
	$password = "root";
	$database = "banco_sisco";
	$connection = mysql_connect($host, $username, $password) or die(mysql_error("erro de Acesso"));
	mysql_select_db($database) or die(mysql_error("erro de conexão"));

