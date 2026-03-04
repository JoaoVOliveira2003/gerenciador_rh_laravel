<?php

use App\Http\Controllers\ColaboratorsControl;
use App\Http\Controllers\ConfirmAccontController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RhManagementController;
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
    Route::redirect('/','home');

    Route::get('/home',function(){
        if(auth()->user()->role==='admin'){
            die('Vai para a pagina inicial do ADMIN');
        }
        elseif(auth()->user()->role==='rh'){
            return redirect()->route('rh.management.home');
        }
        else{
            die('Vai para a pagina inicial do ADMIN');
        }
    })->name('home');

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
    Route::post('/gravarUserRH',[RhUserController::class,'gravarUserRH'])->name('gravarUserRH');
    Route::get('/telaApagarRH/{id}',[RhUserController::class,'telaApagarRH'])->name('telaApagarRH');
    Route::get('/deletarPessoaRH/{id}',[RhUserController::class,'deletarPessoaRH'])->name('deletarPessoaRH');

    Route::get('/telaEditarRH/{id}',[RhUserController::class,'telaEditarRH'])->name('telaEditarRH');
    Route::post('/editarUserRH',[RhUserController::class,'editarUserRH'])->name('editarUserRH');

    Route::get('/verTodosUsuarios',[ColaboratorsControl::class,'index'])->name('verTodosUsuarios');
    Route::get('/verDetalhesUsuario/{id}',[ColaboratorsControl::class,'verDetalhesUsuario'])->name('verDetalhesUsuario');
    Route::get('/colaborador/{id}',[ColaboratorsControl::class,'telaDeletarUsuarioSoft'])->name('telaDeletarUsuarioSoft');
    Route::get('/colaborador/confirmarDelete/{id}',[ColaboratorsControl::class,'DeletarUsuarioSoftConfirm'])->name('DeletarUsuarioSoftConfirm');
    Route::get('/RestoreColaborador/{id}',    [ColaboratorsControl::class,'RestoreColaborador'])->name('RestoreColaborador');

    Route::get('/rhUser/management/home',[RhManagementController::class,'home'])->name('rh.management.home');





});

Route::middleware('guest')->group(function(){
    Route::get('/confirm-acconunt/{token}',[ConfirmAccontController::class,'ConfirmAccont'])->name('ConfirmAccont');
    Route::post('/confirmarConta',[ConfirmAccontController::class,'confirmarConta'])->name('confirmarConta');
});

