﻿<?php

  error_reporting(0);

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  $mail = new PHPMailer(true);

  $name = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $hidden = $_POST['hidden'];
  $mensagem = $_POST['descricao'];

  $fullMail = "
    <head>
      <meta charset='UTF-8'>
    </head>
    <body>
      <p><b>Nome:</b> $name</p>
      <p><b>E-mail:</b> $email</p>
      <p><b>Telefone:</b> $telefone</p><br>
      <p><b>Serviço:</b> <br>$hidden</p>
    </body>
  ";

  try {
    //Server settings
    //$mail->SMTPDebug  = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'mail.deohousecare.com.br';                      // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->CharSet    = 'utf-8';
    $mail->Username   = 'site@deohousecare.com.br';           // SMTP username
    $mail->Password   = 'HejNwCBFH!Ah';                       // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('site@deohousecare.com.br', 'Solicitação de Serviço Formulário');
    $mail->addAddress('site@deohousecare.com.br', 'Solicitação de Serviço Formulário');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Solicitação de Serviço Formulário";
    $mail->Body    = $fullMail;

    $enviado = $mail->Send();

    if ($enviado) {
      echo "Mensagem enviada";
      echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=http://deohousecare.com.br/servico/'>";
    } else {
      echo "Não foi possível enviar o e-mail.";
      echo "Motivo do erro: " . $mail->ErrorInfo;
      echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=http://deohousecare.com.br/servico/'>";
    }
  } catch (Exception $e) {
    echo "Mensagem não foi enviada. Erro: {$mail->ErrorInfo}";
    echo "<meta HTTP-EQUIV='Refresh' CONTENT='2;URL=http://deohousecare.com.br/servico/'>";
  }

?>