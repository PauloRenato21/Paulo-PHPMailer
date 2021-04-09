<?php

include_once "phpmailer/src/PHPMailer.php";
include_once "phpmailer/src/SMTP.php";
include_once "phpmailer/src/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem'];

$mail = new PHPMailer(true);

try{
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "";
    $mail->Password = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // $mail->SMTPOptions = array(
    //     'ssl' => array(
    //         'verify_peer' => false,
    //         'verify_peer_name' => false,
    //         'allow_self_signed' => true
    //     )
    // );

    $mail->setFrom($mail->Username, "$nome");
    $mail->addAddress('');
    $conteudo = "
    Você recebeu uma mensagem de $nome $sobrenome ($email):
    <br>
    <br>
    Mensagem:<br>
    $mensagem
    ";
    
    $mail->isHTML(true);
    $mail->Subject = 'Teste de EmailMailer';
    $mail->Body = $conteudo;
    // $mail->AltBody = ;

    if($mail->send()){
        echo "Email Enviado com Sucesso!!";
    } else{
        echo "Email não enviado";
    }

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
