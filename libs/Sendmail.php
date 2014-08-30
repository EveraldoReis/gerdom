<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sendmail
{

    public static function send(array $data)
    {
        // Inicia a classe PHPMailer
        $mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        //$mail->IsMail();
        $mail->IsSMTP(); // Define que a mensagem será SMTP
        $mail->Host = SMTP_SERVER; // Endereço do servidor SMTP (caso queira utilizar a autenticação, utilize o host smtp.seudomínio.com.br)
        $mail->SMTPAuth = true; // Usar autenticação SMTP (obrigatório para smtp.seudomínio.com.br)
        $mail->Username = SMTP_USER; // Usuário do servidor SMTP (endereço de email)
        $mail->Password = SMTP_PASS; // Senha do servidor SMTP (senha do email usado)
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->From = $data['from_email']; // Seu e-mail
        $mail->Sender = $data['sender_email']; // Seu e-mail
        $mail->FromName = $data['from_name']; // Seu nome
// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->AddAddress($data['to_email'], $data['to_name']);
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta
// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->IsHTML(true); // Define que o e-mail será enviado como HTML
        $mail->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
        $mail->Subject = $data['subject']; // Assunto da mensagem
        $mail->Body = $data['body'];
        $mail->AltBody = strip_tags($mail->Body);

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
// Envia o e-mail
        $enviado = $mail->Send();

// Limpa os destinatários e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();

// Exibe uma mensagem de resultado
        if ($enviado) {
            echo "E-mail enviado com sucesso!";
        } else {
            echo "Não foi possível enviar o e-mail.";
            echo "Informações do erro: " . $mail->ErrorInfo;
        }
    }

}
