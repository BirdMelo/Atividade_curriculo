<?php
// O e-mail para onde as mensagens serão enviadas
$receiving_email_address = 'jpmnbits@gmail.com';

// Se a biblioteca ajax for esperada, este script retorna "OK" no sucesso
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Coleta dos dados
    $name = isset($_POST['name']) ? $_POST['name'] : 'N/A';
    $email = isset($_POST['email']) ? $_POST['email'] : 'N/A';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : 'N/A';
    $message = isset($_POST['message']) ? $_POST['message'] : 'N/A';

    // Montagem do e-mail
    $email_subject = "Mensagem do Formulário: " . $subject;
    
    $email_content = "Nome: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Mensagem:\n$message\n";

    // Cabeçalhos (ajuda a evitar spam)
    $email_headers = "From: " . $name . " <" . $email . ">\r\n";
    $email_headers .= "Reply-To: " . $email . "\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Tenta enviar
    if (mail($receiving_email_address, $email_subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "OK"; // O retorno esperado pelo validate.js
    } else {
        http_response_code(500);
        echo "Erro: Falha no envio do email pelo servidor.";
    }

} else {
    http_response_code(403);
    echo "Acesso proibido.";
}
?>