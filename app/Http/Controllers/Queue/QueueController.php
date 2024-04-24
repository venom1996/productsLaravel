<?php

namespace App\Http\Controllers\Queue;

use App\Services\RabbitMQService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class QueueController extends Controller
{
    protected $rabbitMQService;
    const QUEUE_NAME = 'products';

    public function __construct(RabbitMQService $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function sendToRabbitMQ(Request $request)
    {
        $data = $request->all();

        $this->rabbitMQService->publishMessage(self::QUEUE_NAME, $data);

        return response()->json(['message' => 'Message sent to RabbitMQ']);
    }
}
