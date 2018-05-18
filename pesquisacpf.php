<?php

require_once 'conexao.php';

$cpf = filter_input(INPUT_POST, 'Cpf');


	$query = mysql_query("SELECT cpf FROM pessoa WHERE Cpf = '$cpf'");
	$quantidade = mysql_num_rows($query);
	
	
	if($quantidade == 0){
		
		echo 'Cadastre-se';
                          		
	}
	
	else{
		
            echo 'Desculpe! Este CPF já foi cadastrado no sistema.';
            
		
	}

