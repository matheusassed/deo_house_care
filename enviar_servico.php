<?php

  error_reporting(0);

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';

  $mail = new PHPMailer(true);

  $name = $_POST['nome'];
  $valor = $_POST['valor'];
  $profissional = $_POST['profissional'];
  $contato = $_POST['contato'];
  $mensagem = $_POST['descricao'];

  $fullMail = "
    <head>
      <meta charset='UTF-8'>
    </head>
    <body>
      <p><b>Nome:</b> $name</p>
      <p><b>Faixa de Valor:</b> $valor</p>
      <p><b>Profissional:</b> $profissional</p><br>
      <p><b>Contato:</b> <br>$contato</p>
      <p><b>Descrição:</b> <br>$mensagem</p>
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
    $mail->setFrom('site@deohousecare.com.br', 'Sugestão Serviço Formulário');
    $mail->addAddress('site@deohousecare.com.br', 'Sugestão Formulário');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Sugestão Serviço Formulário";
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