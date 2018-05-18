<?php 
//Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require("phpmailer/class.phpmailer.php");
include 'phpmailer/class.smtp.php';
//    Inicia a classe PHPMailer
$mail = new PHPMailer();
//    Define os dados do servidor e tipo de conex�o
$mail->IsSMTP(); // Define que a mensagem ser� SMTP
$mail->Host = 'smtp.gmail.com'; // Endere�o do servidor SMTP
$mail->Port = 465; //define a porta do servidor SMTP
$mail->SMTPSecure = "ssl";
$mail->SMTPAuth = true; // Autentica��o
$mail->Username = 'siscoeventos@gmail.com'; // Usu�rio do servidor SMTP
$mail->Password = 'sisco@eventos.ifes'; // Senha da caixa postal utilizada
//$mail->SMTPDebug = 2; // Debug do SMTP (para teste)
//    Define o remetente
$mail->From = "siscoeventos@gmail.com"; //seu e-mail
$mail->Sender = "siscoeventos@gmail.com"; // Seu e-mail
$mail->FromName = "SISCO Eventos Acad�micos"; //seu nome
//    Define os destinatário(s) 
$mail->AddAddress('rlocatelli9@gmail.com', 'robson locatelli');
$mail->AddAddress('robson_loc@hotmail.com');
$mail->ReplyTo="robson_loc@hotmail.com";
//$mail->AddCC('robson_loc@hotmail.com', 'Copia'); 
//$mail->AddBCC('CopiaOculta@dominio.com.br', 'Copia Oculta');
//    Define os dados técnicos da Mensagem
$mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)
//    Texto e Assunto
$mail->Subject  = "Certificado do Evento"; // Assunto da mensagem
$mail->Body = '<p>Este é o corpo da mensagem de teste, em HTML!</p>'
        . '<p>Segue anexo ao email, o seu arquivo.</p>';
$mail->AltBody = 'Este é o corpo da mensagem de teste, em Texto Plano! \r\n 
Segue anexo ao email, o seu arquivo.'; //<IMG src="..\img\high_tatras_min.jpg" alt=imagem_do_local":)"  class="wp-smiley">\n
//// Define os anexos (opcional)
//// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$file_to_attach = 'C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs\sisco\anexos\Resumo.pdf';
$mail->AddAttachment($file_to_attach, 'prova.pdf');  // Insere um anexo
//    Envio da Mensagem
$enviado = $mail->Send();
//    Limpa os destinat�rios e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
//    Exibe uma mensagem de resultado
if ($enviado) {
echo "E-mail enviado com sucesso!";
} else {
echo "Não foi possível enviar o e-mail.";
echo "<br><b>Informações do erro: </b>" . $mail->ErrorInfo;
}