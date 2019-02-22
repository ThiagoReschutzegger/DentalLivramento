<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author echoes
 */

/**
 * This example shows how to send via Google's Gmail servers using XOAUTH2 authentication.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;
// Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//Load dependencies from composer
//If this causes an error, run 'composer install'
require 'system/phpmailer/vendor/autoload.php';

class Email {

    //Classe configurada para enviar email através de conta do Google e PHPMailer
    //put your code here
    private $de = 'thiagoreschutzegger@gmail.com';
    private $decontato;
    private $para;
    private $assunto;
    private $mensagem;
    private $html;

    function __construct($para,$decontato, $assunto, $mensagem, $html = NULL) {
        $this->para = $para;
        $this->decontato = $decontato;
        $this->assunto = $assunto;
        $this->mensagem = $mensagem;
        $this->html = $html;
        }

        public function send() {
        /**
         * This example shows settings to use when sending via Google's Gmail servers.
         * This uses traditional id & password authentication - look at the gmail_xoauth.phps
         * example to see how to use XOAUTH2.
         * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
         */
//Import PHPMailer classes into the global namespace
      //  use PHPMailer\PHPMailer\PHPMailer;
        require 'phpmailer/vendor/autoload.php';
//Create a new PHPMailer instance
        $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
        $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $mail->SMTPDebug = 0;
//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "thiagoreschutzegger@gmail.com";
//Password to use for SMTP authentication
        $mail->Password = "thimben10";
//Set who the message is to be sent from
        $mail->setFrom($this->de, 'Admin');
//Set an alternative reply-to address
        $mail->addReplyTo($this->decontato, $this->decontato);
//Set who the message is to be sent to
        $mail->addAddress($this->para, 'Contato');
//Set the subject line
        $mail->Subject = $this->assunto;
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
        $mail->msgHTML($this->mensagem, __DIR__);
//Replace the plain text body with one created manually
        $mail->AltBody = $this->mensagem;
//Attach an image file
        $mail->addAttachment('phpmailer/images/phpmailer_mini.png');
//send the message, check for errors
        if (!$mail->send()) {
            echo "<script>alert('Mensagem não enviada')</script>";
        } else {
            echo "<script>alert('Mensagem enviada com sucesso')</script>";
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
        }



    }
    
    //Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
        function save_mail($mail) {
            //You can change 'Sent Mail' to any other folder or tag
            $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
            //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
            $imapStream = imap_open($path, $mail->Username, $mail->Password);
            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);
            return $result;
        }

}
