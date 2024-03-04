<?php

namespace GustavoMorais\Article\Infrastructure\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use GustavoMorais\Article\Infrastructure\Mail\MailService;

class Consumer
{
    private $channel;
    private $mailer;

    public function __construct()
    {
        $connection = new AMQPStreamConnection('my_rabbitmq', 5672, 'guest', 'guest');
        $this->channel = $connection->channel();
        $this->mailer = new MailService();
    }

    public function consume()
    {
        $this->channel->queue_declare('email', false, true, false, false);
        $callback = function ($msg) {
            $this->mailer->send($msg->body);
            echo 'Sent message: ', $msg->body, "\n";
        };
        $this->channel->basic_consume('email', '', false, true, false, false, $callback);
        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
        echo "Done consuming\n";
        $this->channel->close();
    }
}
