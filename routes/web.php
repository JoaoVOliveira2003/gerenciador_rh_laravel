<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhUserController;
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
    Route::post('/user/profile/update-user-data',[ProfileController::class,'updateUserData'])->name('user.updateUserData');

    Route::get('/departments',[DepartmentController::class,'index'])->name('departments');
    Route::get('/departments/new-departament',[DepartmentController::class,'newDepartment'])->name('departments.newDepartment');
    Route::post('/departments/gravarDepartament',[DepartmentController::class,'gravarDepartament'])->name('departments.gravarDepartament');
    Route::get('/departments/edit-department/{id}',[DepartmentController::class,'editDepartment'])->name('departments.editDepartment');
    Route::post('/departments/update-department',[DepartmentController::class,'updateDepartment'])->name('departments.updateDepartment');
    Route::get('/departments/telaDeletarDepartmento/{id}',[DepartmentController::class,'telaDeletarDepartmento'])->name('departments.telaDeletarDepartmento');
    Route::get('/departments/deletarDepartamento/{id}',[DepartmentController::class,'deletarDepartamento'])->name('departments.deletarDepartamento');

    Route::get('/rhUsers',[RhUserController::class,'index'])->name('rhUsers');
    Route::get('/telaAdicionarRH',[RhUserController::class,'telaAdicionarRH'])->name('telaAdicionarRH');
    });
