<?php

namespace GustavoMorais\Article\Infrastructure\Queue;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Producer
{
    private $channel;

    public function __construct()
    {
        $connection = new AMQPStreamConnection('my_rabbitmq', 5672, 'guest', 'guest');
        $this->channel = $connection->channel();
    }

    public function produce($email = null, $message = null)
    {
        $queuedMessage = ['email' => $email, 'message' => $message];
        $this->channel->queue_declare('email', false, true, false, false);
        $newMessage = new AMQPMessage(
            json_encode($queuedMessage),
            [
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
            ]
        );

        $this->channel->basic_publish($newMessage, '', 'email');

        $this->channel->close();
    }
}
