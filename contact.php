<?php
if (count($_POST) > 0 && empty($_POST['checkSpan'])) { // verificação se é um robo que esta preenchendo o formulario "<input type="text" name="checkSpan" style="display:none">"
  require "PHPMailer-master/PHPMailerAutoload.php";

  $nome = $_POST['nome'];
  $email = $_POST['email'];

  $mensagem = "<b>Nome: </b>" . $nome . "<br>";
  $mensagem .= "<b>Email: </b>" . $email . "<br>";
  $mensagem .= "<b>Mensagem: </b>" . $_POST['mensagem'];

  $mail = new PHPMailer;
  $mail->isHTML(true); // define que o e-mail contem um html
  $mail->isSMTP(); // ativa o smtp
  $mail->SMTPDebug = 1; // ativa o debug (mostra erros)
  $mail->SMTPAuth = true; // define que o smtp é autenticado - "ALTERAR CONF"
  $mail->SMTPSecure = 'ssl'; // define que o smtp usa ssl - "ALTERAR CONF"
  $mail->Host = 'smtp.gmail.com'; // define o endereço do smtp - "ALTERAR CONF"
  $mail->Port = 587; // define a porta do smtp - "ALTERAR CONF"
  $mail->Username = 'email que envia'; // define o e-mail
  $mail->Password = 'digitar a senha do email';// define a smtp

  $mail->SetFrom($email, $nome); // define e-mail e nome do remetente
  $mail->Subject = 'Contato do site'; // define o assunto
  $mail->Body = $mensagem; // corpo do email/mensagem
  $mail->AddAddress('endereço que vai receber'); // define o destinatario
  $mail->AddAttchment($_FILES['anexo']['tmp_name'],
                     $_FILES['anexo']['name']); // adiciona o anexo, envia via upload

//   print "<pre>";
//   print_r ($_FILES);
//   print "</pre>";
//   CONTEÚDO DO UPLOAD


  $envio = $mail->Send(); // envia o email

  if($envio) {
    print "Email enviado com sucesso";
  } else {
    print "Ocorreu uma olha no envio do email";
  }
}
?>
