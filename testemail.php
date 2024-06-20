<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
/* 
<?php
$to = "email@destinatario.com";
$subject = "Assunto do e-mail";
$message = "Corpo do e-mail";

$headers = "From: seuemail@seudominio.com\r\n";
$headers .= "Reply-To: seuemail@seudominio.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$headers .= "Disposition-Notification-To: seuemail@seudominio.com\r\n";

mail($to, $subject, $message, $headers);
?> */
$name = "Demerval Alves Junior";
$email = 'juniormalk@gmail.com';
$phone = $_POST['phone'];
// $subject = $_POST['subject'];
$message = 'TESTE DE CONFIRMAÇÂO DE LEITURA';

//sendmail using phpmailer and gmail
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
//Server settings
$mail->SMTPDebug = 0; 
//set utf8
$mail->CharSet = 'UTF-8';                                // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.centersite.com.br';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'form@centersite.com.br';                 // SMTP username
$mail->Password = 'LJGiIlsVx5C0Rey##x';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;    

$mail->setFrom($email); 
$mail->addAddress('junior@akinfo.com.br', 'AK Info');
$mail->addReplyTo($email, $name);
$mail->addCustomHeader('Disposition-Notification-To:junior@akinfo.com.br');
$mail->AddCustomHeader( 'X-pmrqc: 1' );
$mail->AddCustomHeader( "X-Confirm-Reading-To:junior@akinfo.com.br" );
$mail->ConfirmReadingTo = "junior@akinfo.com.br";


$mail->isHTML(true); 
                                 // Set email format to HTML
$message = "Name: $name <br> Email: $email <br> Phone: $phone <br><br> Message: $message";
$mail->Subject = 'Contato do site - AK Info';
$mail->Body    = $message;
$mail->AltBody = $message;

if(!$mail->send()) {
    //json response
    $reponse = array('status' => 'error', 'message' => 'Message could not be sent.');
} else {
    $reponse = array('status' => 'success', 'message' => 'Message has been sent');
}
echo json_encode($reponse);