<?php

use App\Http\Controllers\MessageTeamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// NAVEGAÇÃO
Route::get('/pagina-nao-encontrada', [NavigationController::class, 'page_not_found'])->name('page_not_found'); //página Sobre
Route::get('/', [NavigationController::class, 'index'])->name('index'); //página Home

//USUARIO NÃO LOGADO
Route::group(['middleware' => 'guest'], function () {
    // Login
    Route::get('/login', [NavigationController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login']);

    // Criar conta
    Route::get('/register', [NavigationController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'createAccount']);
});



//USUARIO LOGADO
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');//sair da conta

    // 
    // Route::get('/team/{team_code}', [UserController::class, 'team'])->name('team');//turma especifica
    // Route::get('/teams', [UserController::class, 'teams'])->name('teams');//todas as turmas
    // Route::post('/team/send-message', [UserController::class, 'messageTeam'])->name('team.message');//envia mensagem na turma
    // Route::post('/team/update-message', [UserController::class, 'updateMessage'])->name('message.update');//edita mensagem da turma
    // Route::post('/team/enter', [UserController::class, 'enterTeam'])->name('team.enter');//entrar na turma
    // Route::post('/delete-message/{id_message_team}', [UserController::class, 'deleteMessage'])->name('message.delete');//APAGAR MENSAGEM

     // TURMA
    Route::group(['prefix' => 'teams'], function () {
        Route::get('/', [TeamController::class, 'index'])->name('teams');//todas as turmas
        Route::get('/store', [TeamController::class, 'new'])->name('team.store');//VIEW CRIAR TURMA
        Route::post('/store', [TeamController::class, 'store']);//VIEW CRIAR TURMA
        Route::post('/delete/{id_team}', [TeamController::class, 'delete'])->name('team.delete');//APAGAR TURMA
        Route::get('/edit/{id_team}', [TeamController::class, 'edit'])->name('team.edit');//VIEW EDITAR TURMA
        Route::post('/edit/{id_team}', [TeamController::class, 'update']);//VIEW EDITAR TURMA
        Route::post('/enter', [TeamController::class, 'enter'])->name('team.enter');//entrar na turma
        
        Route::group(['prefix' => 'messages'], function () {
            Route::post('/store', [MessageTeamController::class, 'store'])->name('team.message');//envia mensagem na turma
            Route::post('/delete/{id_message_team}', [UserController::class, 'deleteMessage'])->name('message.delete');//APAGAR MENSAGEM
            Route::post('/update', [UserController::class, 'updateMessage'])->name('message.update');//edita mensagem da turma
        });

        Route::get('/{team_code}', [TeamController::class, 'view'])->name('team');//turma especifica
    });

    // SÓ ADMIN PODE ACESSAR
    Route::middleware('admin')->group(function () {
        Route::post('/remove-user/{id}', [AdminController::class, 'removeUserTeam'])->name('team.remove_user');//APAGAR MENSAGEM
    });
});



Route::get('/@{username}', [UserController::class, 'viewAccount'])->name('account');//visualizar da conta