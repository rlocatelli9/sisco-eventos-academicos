<?php
include("conexao.php");
require("phpmailer/class.phpmailer.php");
include 'phpmailer/class.smtp.php';
//    Inicia a classe PHPMailer
$mail = new PHPMailer();
//    Define os dados do servidor e tipo de conexão
$mail->IsSMTP(); // Define que a mensagem ser� SMTP
$mail->Host = 'smtp.gmail.com'; // Endere�o do servidor SMTP
$mail->Port = 465; //define a porta do servidor SMTP
$mail->SMTPSecure = "ssl";
$mail->SMTPAuth = true; // Autentica��o
$mail->Username = 'siscoeventos@gmail.com'; // Usu�rio do servidor SMTP
$mail->Password = 'sisco@eventos.ifes'; // Senha da caixa postal utilizada
?>

<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="img/favicon.gif" />
        <title>Recuperação de Senha</title>
        <link rel="stylesheet" href="css/jquery-ui.css">
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <!--        Bootstrap -->
        <script src="js/bootstrap.min.js"></script>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/validacao.js"></script>        
    </head>
    <body>
        <div class="container" align="center">
            <div><p><a href="http://alegre.ifes.edu.br" target="_blank"><img alt="logo_Ifes" src="img/background_cabecalho.jpg"></a></div>
            <div class="row-fluid">
                <div role="main">
                    <div class="container-fluid">
                        <div class="row-fluid">
                            <div class="span12">
                                <br>

                                <?php
                                if (isset($_POST["enviar"])) {

                                    $cpf = $_POST['cpf'];
                                    $emailform = $_POST['email'];

                                    $buscasql = "SELECT * FROM pessoa WHERE cpf='$cpf'";
                                    $querysql = mysql_query($buscasql);
                                    $dados = mysql_fetch_array($querysql);

                                    $emailsql = $dados["email"];
                                    $senha = $dados["senha"];
                                    $nome = $dados["nome"];

                                    if ($emailform == $emailsql) {
                                        $assunto = "Recuperação de senha!";
                                        $mensagem = "Presado sr. " . $nome . ",<br><br>";
                                        $mensagem .= "Esta mensagem foi enviada ao senhor pois solicitou a recuperação de seus dados de login em nosso portal. Abaixo seguem seus dados:";
                                        $mensagem .= "<p>Login de acesso: " . $emailsql . "<br>";
                                        $mensagem .= "Senha: " . $senha . "</p>";

                                        $mail->From = "siscoeventos@gmail.com"; //seu e-mail
                                        $mail->Sender = "siscoeventos@gmail.com"; // Seu e-mail
                                        $mail->FromName = "SISCO Eventos Acadêmicos"; //seu nome

                                        $mail->AddAddress($emailsql, $nome);
                                        //$mail->AddAddress();
                                        //$mail->ReplyTo = "rlocatelli9@gmail";
                                        $mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
                                        $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
                                        //    Texto e Assunto
                                        $mail->Subject = $assunto; // Assunto da mensagem
                                        $mail->Body = $mensagem;
                                        //$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n Ative seu cadastro <a href='http://127.0.0.1/sisco/ativar.php?id=$idmail'>Aqui</a>";
//    Envio da Mensagem
                                        $enviado = $mail->Send();

                                        //$smtp->Send($emailform, "siscoeventos@gmail.com", "Recuperação de Senha", $mensagem); //Os readers já estão configurados na classe smtp (smtp.class.php)

                                        echo "<h4>Seus dados foram enviados ao seu email com sucesso!</h4>";
                                        echo "<h4>Clique no botão abaixo para voltar a página inicial.</h4>";
                                        echo "Caso não encontre o email com o nome 'SISCO Eventos Acadêmicos' em sua caixa de entrada, verifique sua caixa de Spam.";
                                        ?>
                                        <br/>
                                        <form action="index.php" method="POST" id="form1" name="form1" >
                                            <button type="submit" class="btn btn-success" name="voltar" title="Página inicial">Página inicial</button>
                                        </form>
                                        <?php
                                    } else {

                                        echo "<h4>Os dados informados não são compatíveis com os cadastrados!</h4>";
                                        echo "<h6>Verifique se são os dados cadastrados anteriormente.<br>";
                                        ?>
                                        <br/>
                                        <form action="recuperar_senha.php" method="POST" id="form2" name="form2" >
                                            <button type="submit" class="btn btn-info" name="voltar" title="Recuperar Senha">Tentar novamente</button>
                                        </form>
                                        <br/>
                                        <form action="index.php" method="POST" id="form3" name="form3" >
                                            <button type="submit" class="btn btn-success" name="voltar" title="Página inicial">Página inicial</button>
                                        </form>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div style="width:60%">
                                        <form action="<?php $PHP_SELF ?>" method="POST" name="recupera" id="form4">

                                            <h3>Recuperação de Senha</h3>

                                            <p>Preencha corretamente os dados abaixo para que sua senha seja encaminhada ao seu e-mail:</p>
                                            <div class="form-group">
                                                <label for="InputCpf">CPF:</label>
                                                <input id="Cpf" name="cpf" class="form-control" type="text" size="20" maxlength="11" placeholder="00000000000" title="Informe somente os números">
                                                <span id="helpBlock" class="help-block">Ao informar o CPF, insira somente números.</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="InputEmail">Email:</label>
                                                <input id="e-mail" name="email"  class="form-control" type="text" placeholder="exemplo@email.com" title="informe seu email"> 
                                            </div>

                                <!--CPF: <input type="text" name="cpf" size="35"><br /> <br />-->
                                <!--E-mail: <input type="text" name="email" ><br /><br />-->
                                            <button type="submit" class="btn btn-info" name="enviar" title="Recuperar Senha">Recuperar Senha</button>
                                            <!--input type="submit" name="enviar" value="Recuperar!">-->
                                        </form>
                                    </div>
                                    <?php
                                }
                                ?>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "rodape.php" ?>
            </div>
        </div>
    </body>
</html>