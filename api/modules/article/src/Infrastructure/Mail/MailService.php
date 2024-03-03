<?php

namespace GustavoMorais\Article\Infrastructure\Mail;

use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;

class MailService
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new Swift_Mailer(new Swift_SmtpTransport('mailhog_php', 1025));
    }

    public function send($messageContent)
    {
        $message = new Swift_Message();
        $message->setTo('test@email.com');
        $message->setSubject('Test');
        $message->setFrom('test@email.com');
        $message->setBody($messageContent);
        return $this->mailer->send($message);
    }
}
