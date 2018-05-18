<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $idmail= filter_input(INPUT_GET,'id');
            if(isset($idmail)){
                include("conexao.php");
                mysql_query("UPDATE pessoa SET ativo=1 WHERE idpessoa='$idmail'");
                echo 'Cadastro ativado com sucesso.';
                header("location:./index.php"); #direciona para a raiz do site

            }else{
                echo 'Erro: mysql_error()';
            }
        ?>
    </body>
</html>
