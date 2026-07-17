<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['fname']);
    $last_name = htmlspecialchars($_POST['lname']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $message = htmlspecialchars($_POST['message']);
    $page_url = htmlspecialchars($_SERVER['HTTP_REFERER']);    
    $page_name = "CONTACTO-PT";

    if (empty($first_name) || empty($last_name) || empty($email) || empty($subject) || empty($message)) {
        echo "Todos os campos são de preenchimento obrigatório.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Introduza o seu endereço de e-mail válido.";
        exit;
    }

    if (!preg_match('/^[0-9\+]+$/', $mobile)) {
        echo "Introduza número de telemóvel válido.";
        exit;
    }

    $ticket_number = "TICKET-CS" . rand(1000000, 9999999);

    $salt = "991";
    $unique_id = md5($email . $salt);

    $to = "hello@frompedrosilva.nl";
    $from_name = "PEDRO SILVA - PHOTOGRAPHY";
    $from_email = "noreply@frompedrosilva.nl";
    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    // $headers .= "BCC: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $email_subject = "[" . $ticket_number . "] New Ticket - " . $subject;
    $email_body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; margin: 0; padding: 0; }
            .email-container { max-width: 600px; margin: auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center; }
            .content { text-align: left; padding: 20px; }
            .footer { padding: 10px; text-align: center; color: #333; }
            .ticket-info { font-weight: bold; }
            .contact-info { margin-top: 20px; text-align: left; }
            h2 { color: #333; }
            .blue-text { color: #007bff; }
            .disclaimer { font-style: italic; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='email-container'>
            <img src='https://photo.frompedrosilva.nl/assets/www/images/logo-black.png' alt='PEDRO SILVA - PHOTOGRAPHY' width='315' height='65'>
            <hr>
            <div class='content'>
                <h2><span class='blue-text'>Envio de Formulário de Contacto (<a href='{$page_url}'>{$page_name}</a>)</h2>
                <p><strong>Ticket:</strong> {$ticket_number}</p>
                <p><strong>ID Único:</strong> {$unique_id}</p>
                <br>
                <p><strong>Nome:</strong> {$first_name}</p>
                <p><strong>Apelido:</strong> {$last_name}</p>
                <p><strong>Telemóvel:</strong> {$mobile}</p>
                <p><strong>Email:</strong> {$email}</p>
                <br>
                <p><strong>Assunto:</strong> {$subject}</p>
                <p><strong>Mensagem:</strong><br><b>'</b>{$message}<b>'</b></p>
            </div>
                <hr>
                <p class='disclaimer'>Este e-mail foi enviado à Administração.<br><a href='https://photo.frompedrosilva.nl/'>PEDRO SILVA - PHOTOGRAPHY</a></p>
        </div>
    </body>
    </html>";

    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Mensagem enviada com sucesso! Ticket nº {$ticket_number}.";

        $client_subject = "Submissão para JOAO VICENTE - PHOTOGRAPHY";
        $client_body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; margin: 0; padding: 0; }
                .email-container { max-width: 600px; margin: auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center; }
                .content { text-align: left; padding: 20px; }
                .footer { padding: 10px; text-align: center; color: #333; }
                .ticket-info { font-weight: bold; }
                h2 { color: #333; }
            .blue-text { color: #007bff; }
            .disclaimer { font-style: italic; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='email-container'>
                <img src='https://photo.frompedrosilva.nl/assets/www/images/logo-black.png' alt='PEDRO SILVA - PHOTOGRAPHY' width='315' height='65'>
                <hr>
                <div class='content'>
                    <p><strong>Caro {$first_name} {$last_name},</strong></p>
                    <p>Obrigado por entrar em Contacto. Recebemos a sua mensagem e retornaremos o mais breve possível.</p>
                    <br>
                    <p><strong>Ticket:</strong> {$ticket_number}</p>
                    <p><strong>ID Único:</strong> {$unique_id}</p>
                    <p>Se tiver alguma informação ou dúvida adicional, sinta-se livre para responder a este e-mail.</p>
                    <br>
                    <p><strong><i>Com os melhores cumprimentos,</i><br>Equipa PEDRO SILVA - PHOTOGRAPHY</strong></p>
                </div>
                <hr>
                <p class='disclaimer'>Obrigado por nos Contactar!<br><a href='https://photo.frompedrosilva.nl/'>PEDRO SILVA - PHOTOGRAPHY</a></p>
            </div>
        </body>
        </html>";

        $client_headers = "From: $from_name <$from_email>\r\n";
        //$client_headers .= "Reply-To: $from_email\r\n";
        $client_headers .= "Reply-To: hello@frompedrosilva.nl\r\n";
        $client_headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        mail($email, $client_subject, $client_body, $client_headers);

    } else {
        echo "A mensagem não foi enviada. Por favor, tente mais tarde.";
    }
} else {
    echo "Método de pedido inválido.";
}
?>
