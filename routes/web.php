<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Products\DashboardProduct;
use App\Http\Controllers\Queue\QueueController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('start');
});

Route::get('/dashboard', function () {

    $productsData = DashboardProduct::index();

    return view('dashboard')->with('data', $productsData);
})->middleware(['auth', 'verified'])->name('dashboard');

//проверяем через middleware, только авторизованные юзеры могут слать запросы в контроллер
Route::post('/dashboard', [QueueController::class, 'sendToRabbitMQ'])->name('dashboard')->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
