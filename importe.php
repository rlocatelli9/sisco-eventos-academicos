<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>SISCO Eventos Acadêmicos</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container" >
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
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
                                <?php
                                // inclui a conexão
                                //include_once('conexao.php');
                                $conexao = mysql_connect("localhost", "root", "root");
                                if (!$conexao) {
                                    die("falha ao conectar ao banco");
                                }
                                $bd = mysql_select_db("banco_sisco");
                                $nome_arquivo = "file\dados.csv";
                                // Abre o Arquvio no Modo r (para leitura)
                                $arquivo = fopen($nome_arquivo, 'r');
                                // Lá o conteúdo do arquivo
                                while (($dados = fgetcsv($arquivo, 1024, ";")) !== FALSE) {
                                    $sql = "INSERT INTO pessoa(idpessoa,nome,cpf,sexo,email,instituicaoorigem,senha,confirmasenha) 
          VALUES ('" . $dados[0] . "', '" . $dados[1] . "', '" . $dados[2] . "', '" . $dados[3] . "', '" . $dados[4] . "', '" . $dados[5] . "', '" . $dados[6] . "', '" . $dados[7] . "');";
                                    mysql_query($sql) or die(mysql_error());
                                }
                                // Fecha arquivo aberto
                                fclose($arquivo);
                                echo "Tabela preenchida";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "rodape.php" ?>
                <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
                <script src="js/jquery.js"></script>
                <script src="js/bootstrap.min.js"></script>
            </div>
        </div>
    </body>
</html>