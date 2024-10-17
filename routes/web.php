<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GupShupController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/chat/room',[GupShupController::class,'chatroom'])->name('chatroom');
Route::post('/fire/message',[GupShupController::class,'fireMessage'])->name('sent.message');
