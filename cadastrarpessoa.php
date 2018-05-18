<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="img/favicon.gif" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISCO Eventos Acadêmicos</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- jQuery (necessario para os plugins Javascript Bootstrap) -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="Site Ifes" src="img/background_cabecalho.jpg" ></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span3">
                                <div id="doc-esquerda">
                                    <?php include "menu.php" ?>
                                </div>
                            </div>
                            <div class="span9">
                                <br><br>
                                <?php
                                $conect = new mysqli('localhost', 'root', 'root', 'banco_sisco');
                                if (!$conect) {
                                    die('erro ao conectar ao banco de dados');
                                }
                                //verificando email e recolhendo valor
                                $email = filter_input(INPUT_POST, 'Email');

                                # Verificando apenas um campo, no caso dado1.
                                $sql = $conect->query("SELECT * FROM pessoa WHERE email='$email'");

                                if (mysqli_num_rows($sql) > 0) {
//                                    echo '<script>alert("Email não disponível para cadastro!")</script>';
                                    ?>
                                    <script language="JavaScript">
                                        alert('Email não disponível para cadastro!');
                                        history.back();
                                    </script>
                                <?php
                                } else {
                                    include("conexao.php");
                                    $essequeli = "INSERT INTO pessoa (nome, sexo, cpf, data_nasc, email, instituicaoorigem, nome_instituicao, telefone, cidade, estado, senha, confirmasenha, ativo)
                                    VALUES ('" . utf8_decode(filter_input(INPUT_POST, 'Nome')) . "',
                                            '" . filter_input(INPUT_POST, 'Sexo') . "',
                                            '" . filter_input(INPUT_POST, 'Cpf') . "',
                                            '" . filter_input(INPUT_POST, 'Data_Nasc') . "',    
                                            '" . filter_input(INPUT_POST, 'Email') . "',
                                            '" . filter_input(INPUT_POST, 'Origem') . "',
                                            '" . utf8_decode(filter_input(INPUT_POST, 'Nome_Instituicao')) . "',
                                            '" . filter_input(INPUT_POST, 'Telefone') . "',
                                            '" . utf8_decode(filter_input(INPUT_POST, 'Cidade')) . "',
                                            '" . filter_input(INPUT_POST, 'Estado') . "',    
                                            '" . utf8_decode(filter_input(INPUT_POST, 'Senha')) . "',
                                            '" . utf8_decode(filter_input(INPUT_POST, 'ConfSenha')) . "',
                                            0)";
                                    mysql_query($essequeli);
                                }
                                if ($essequeli) {

                                    $nomemail = filter_input(INPUT_POST, 'Nome');
                                    $senhaemail = filter_input(INPUT_POST, 'Senha');

                                    $conexaoemail = mysql_query("SELECT * FROM pessoa WHERE nome = '$nomemail'");
                                    $resultadoconex = mysql_fetch_array($conexaoemail);
                                    $idmail = $resultadoconex['idpessoa'];

                                    $assunto = "Confirmação de Cadastro";
                                    $mensagem = "<table border=1>";
                                    $mensagem .= "<thead>";
                                    $mensagem .= "<tr>";
                                    $mensagem .= "<th>Ativação de Cadastro</th>";
                                    $mensagem .= "</tr>";
                                    $mensagem .= "</thead>";
                                    $mensagem .= "<tbody>";
                                    $mensagem .= "<tr>";
                                    $mensagem .= "<td>Seu cadastro foi realizado com sucesso.</td>";
                                    $mensagem .= "</tr>";
                                    $mensagem .= "<tr>";
                                    $mensagem .= "<td>Porém, para acessar o painel do usário, é preciro confirmar seu cadastro.</td>";
                                    $mensagem .= "</tr>";
                                    $mensagem .= "<tr>";
                                    $mensagem .= "<td>Ative sua conta, clicando <a href='http://10.0.0.106/sisco/ativar.php?id=$idmail'>Aqui</a></td>";
                                    $mensagem .= "</tr>";
                                    $mensagem .= "</tbody>";
                                    $mensagem .= "</table>";
                                    $remetente = "Sisco Eventos Acadêmicos";
//Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
                                    require("phpmailer/class.phpmailer.php");
                                    include 'phpmailer/class.smtp.php';
//    Inicia a classe PHPMailer
                                    $mail = new PHPMailer();
//    Define os dados do servidor e tipo de conexão
                                    $mail->IsSMTP(); // Define que a mensagem será SMTP
                                    $mail->Host = 'smtp.gmail.com'; // Endereço do servidor SMTP
                                    $mail->Port = 465; //define a porta do servidor SMTP
                                    $mail->SMTPSecure = "ssl";
                                    $mail->SMTPAuth = true; // Autenticação
                                    $mail->Username = 'siscoeventos@gmail.com'; // Usuário do servidor SMTP
                                    $mail->Password = 'sisco@eventos.ifes'; // Senha da caixa postal utilizada
//$mail->SMTPDebug = 2; // Debug do SMTP (para teste)
//    Define o remetente
                                    $mail->From = "siscoeventos@gmail.com"; //seu e-mail
                                    $mail->Sender = "siscoeventos@gmail.com"; // Seu e-mail
                                    $mail->FromName = $remetente; //seu nome
//    Define os destinat�rio(s) 
                                    $mail->AddAddress($email, $nomemail);
                                    //$mail->AddAddress();
                                    $mail->ReplyTo = "rlocatelli9@gmail.com";
//    Define os dados t�cnicos da Mensagem
                                    $mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
                                    $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
//    Texto e Assunto
                                    $mail->Subject = $assunto; // Assunto da mensagem
                                    $mail->Body = $mensagem;
                                    //$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n Ative seu cadastro <a href='http://127.0.0.1/sisco/ativar.php?id=$idmail'>Aqui</a>";
//    Envio da Mensagem
                                    $enviado = $mail->Send();
//    Exibe uma mensagem de resultado
                                    if ($enviado) {
                                        echo "<script>alert('Verifique sua caixa de entrada ou caixa de spam. E confirme seu cadastro.')</script>";
                                        echo "<script>window.location.href='index.php'</script>";
                                    } else {
                                        echo "aguarde, por favor...";
                                        echo "<script>alert('Cadastro Realizado. Porém foi possível enviar o e-mail de ativação. Contate o administrador do sistema.')</script>";
                                        echo "<script>alert('Informações do erro. $mail->ErrorInfo')</script>";
                                        echo "<script>window.location.href='index.php'</script>";
                                    }
//    Limpa os destinat�rios e os anexos
                                    $mail->ClearAllRecipients();
                                    $mail->ClearAttachments();
                                } else {
                                    session_start(); // Inicia a sess�o
                                    session_destroy(); // Destr�i a sess�o limpando todos os valores salvos
                                    ?>
                                    <script language="JavaScript">
                                        alert('Não foi possível capturar os dados. Tente novamente mais tarde!');
                                        location.href='index.php';
                                    </script>
                                <?php // Redireciona o visitante
                                }
                                ?>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
<?php include "rodape.php" ?>
    </body>
</html>