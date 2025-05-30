<?php

    // Recupera os dados enviados pelo o form
    $GetPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if (!empty($GetPost)) {

        // Valiáveis locais
        $Subject = $GetPost['subject'];
        $Name    = $GetPost['name'];
        $Email   = $GetPost['email'];
        $Message = $GetPost['message'];

        // incluir a classe PHPMailer
        include_once './PHPMailer/class.smtp.php';
        include_once './PHPMailer/class.phpmailer.php';

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "thiago.viajante-livre@gmail.com";
        $mail->Password = "Admin100102";

        $mail->setFrom($Email, $Name);
        $mail->addReplyTo($Email, $Name);
        // $mail->addAddress('fernando.rodrigodejesus@gmail.com', 'John Doe');
        $mail->addAddress('thiago.palmeira@viajante-livretrading.com.br', 'Thiago Palmeiras');
        $mail->IsHTML(true);
        $mail->Subject = 'Contato Site - ' . $Subject . ' ' . date("H:i") . ' - ' . date("d/m/Y");
        $mail->Body = '<b>Nome:</b> '. $Name .'<br>  <b>Assunto: </b>'. $Subject .'<br>  <b>E-mail: </b>'. $Email .'<br>  <b>Mensagem: </b>'. $Message .'<br>';


        if (!$mail->send()) {
            $result = array('status'=>0, 'message'=>"Mailer Error: ".$mail->ErrorInfo);
            echo json_encode($result);
        } else {
            echo "success";
        }

    } else {
        return false;
    }