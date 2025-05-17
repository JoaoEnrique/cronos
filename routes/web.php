<?php

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

    Route::post('/delete-account/{id}', [UserController::class, 'deleteAccount'])->name('user.delete');//deletar conta
    Route::get('/edit', [NavigationController::class, 'edit'])->name('account.edit');//usuário logado apaga sua conta
    Route::post('/update-account', [UserController::class, 'updateAccount'])->name('account.update');//usuário logado apaga sua conta
    Route::post('/update-img', [UserController::class, 'updateImgAccount'])->name('account.update_img');//usuário logado apaga sua conta


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
            Route::post('/store', [UserController::class, 'messageTeam'])->name('team.message');//envia mensagem na turma
            Route::post('/delete/{id_message_team}', [UserController::class, 'deleteMessage'])->name('message.delete');//APAGAR MENSAGEM
            Route::post('/update', [UserController::class, 'updateMessage'])->name('message.update');//edita mensagem da turma
        });

        Route::get('/{team_code}', [TeamController::class, 'view'])->name('team');//turma especifica
    });

    // SÓ ADMIN PODE ACESSAR
    Route::middleware('admin')->group(function () {
        //listagem de usuário
        Route::get('/list-admins', [AdminController::class, 'listAdmins'])->name('admin.list_admins');//LISTAR ADMINS
        Route::get('/list-students', [AdminController::class, 'listStudents'])->name('admin.list_students');//LISTAR ALUNOS
        Route::get('/create-admin', [NavigationController::class, 'create_admin'])->name('admin.create');//VIEW CRIAR ADMIN
        Route::post('/create-admin', [AdminController::class, 'createAdmin']);//CRIAR ADMIN
       
        Route::get('/search-admin', [AdminController::class, 'searchAdmin'])->name('admin.search_admin'); //Pesquisa admin
        Route::get('/search-student', [AdminController::class, 'searchStudent'])->name('admin.search_student'); //Pesquisa admin

        
        Route::post('/switch-to-administrator/{id}', [AdminController::class, 'switch_to_administrator'])->name('admin.switch_to_administrator');//MUDAR CADASTRO PARA ADMIN
        Route::post('/switch-to-student/{id}', [AdminController::class, 'switch_to_student'])->name('admin.switch_to_student');//MUDAR CADASTRO PARA USUARIO COMUM

        // MENSAGEM
        
        Route::post('/remove-user/{id}', [AdminController::class, 'removeUserTeam'])->name('team.remove_user');//APAGAR MENSAGEM
        Route::get('/contact', [AdminController::class, 'viewContact'])->name('admin.contact');//APAGAR MENSAGEM
        Route::post('/contact-admin/delete-contact/{id_contact}', [AdminController::class, 'deleteContact'])->name('contact.delete');//apaga mensagem de contato
    });
});



Route::get('/@{username}', [UserController::class, 'viewAccount'])->name('account');//visualizar da conta