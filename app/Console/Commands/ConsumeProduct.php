<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\RabbitMQService;
use App\Models\Products;
class ConsumeProduct extends Command
{
    protected $signature = 'app:consume-product';

    protected $description = 'Command description';

    public function handle()
    {
        $rabbitMQService = new RabbitMQService();
        $rabbitMQService->consumeMessage('products', function ($message) {

            $data = json_decode($message->body, true);

            $arFieldsData = [
                'name' => $data['name'],
                'description' => $data['description'],
                'user_id' => $data['user_id'],
                'price' => (int)$data['price'],
                //'path_photo' => $data['photo']
            ];


            var_dump($arFieldsData);

            Products::create($arFieldsData);
        });
    }
}
