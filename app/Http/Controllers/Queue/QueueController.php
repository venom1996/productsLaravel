<?php

namespace App\Http\Controllers\Queue;

use App\Services\RabbitMQService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        if ($request->hasFile('photo')) {

            //текущий авторизованный юзер
            $user = Auth::user();
            // Получаем файл из запроса
            $photo = $request->file('photo');

            $path = 'uploads/photos';

            //$filename = uniqid() . '_' . $photo->getClientOriginalName();
            $filename = $photo->getClientOriginalName();
            // Сохраняем
            $photo->move($path, $filename);


            //массив для отправки в очередь
            $arFields = [
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'photo' => $path . '/' . $filename,
                'user_id' => $user['id']
            ];

            $this->rabbitMQService->publishMessage(self::QUEUE_NAME, $arFields);

            return response()->json(['message' => true], 200);
        }

        return false;
    }
}
