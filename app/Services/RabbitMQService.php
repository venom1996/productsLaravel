<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQService
{
    protected $connection;
    protected $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST'),
            env('RABBITMQ_PORT'),
            env('RABBITMQ_LOGIN'),
            env('RABBITMQ_PASSWORD')
        );
        $this->channel = $this->connection->channel();
    }

    public function publishMessage($queueName, $message)
    {
        $this->channel->queue_declare($queueName, false, true, false, false);
        $msg = new AMQPMessage(
            json_encode($message),
            ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
        );
        $this->channel->basic_publish($msg, '', $queueName);
    }

    public function consumeMessage($queueName, $callback)
    {
        $this->channel->queue_declare($queueName, false, true, false, false);
        $this->channel->basic_consume($queueName, '', false, true, false, false, $callback);

        while ($this->channel->is_consuming()) {
            $this->channel->wait();
        }
    }

    public function closeConnection()
    {
        $this->channel->close();
        $this->connection->close();
    }
}
