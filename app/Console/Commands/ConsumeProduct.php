<?php

namespace App\Console\Commands;

use App\Helpers\Picture;
use Illuminate\Console\Command;
use App\Services\RabbitMQService;
use App\Models\Products;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
class ConsumeProduct extends Command
{
    protected $signature = 'app:consume-product';

    protected $description = 'Command description';

    public function handle()
    {
        $rabbitMQService = new RabbitMQService();
        $rabbitMQService->consumeMessage('products', function ($message) {

            $data = json_decode($message->body, true);

            $folderPath = 'public/';
            $fileName = 'image_' . time() . '.jpg';

            $objPicture = new Picture($folderPath.$fileName);
            $image_base64 = base64_decode($data['photo']);

            $objPicture->createImageFromBase64($image_base64);

            $arFieldsData = [
                'name' => $data['name'],
                'description' => $data['description'],
                'user_id' => $data['user_id'],
                'price' => (int)$data['price'],
                'path_photo' => '/storage/'.$fileName
            ];

            Products::create($arFieldsData);
        });
    }
}
