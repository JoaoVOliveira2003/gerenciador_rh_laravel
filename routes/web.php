<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/enviarEmailTest', function () {
    // Lembrando que tem HailHog no meio
    Mail::raw('Mensagem de texto',function(Message $message){
        $message->to('teste@gmail.com')
        ->subject('bem vindo')
        ->from('rh@rhmangnt.com');
    });
    echo 'email enviado';
});

Route::middleware('auth')->group(function(){
    Route::view('home','home')->name('home');
    Route::redirect('/','home');

    Route::get('/user/profile',[ProfileController::class,'index'])->name('user.profile');
    Route::post('/user/profile/update-password',[ProfileController::class,'updatePassword'])->name('user.updatePassword');
});
