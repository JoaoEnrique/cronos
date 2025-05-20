<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    // HOME
    public function index(){
        if(auth()->check()){
            return redirect()->route('teams');
        }
        return view('index');
    }

    // LOGIN
    public function login(){
        return view('user.login');
    }

    // Cadastrar
    public function register(){
        return view('user.register');
    }

    // EDITAR
    public function edit(){
        return view('user.edit');
    }

    // ERRO 404
    public function page_not_found(){
        return view('errors.404');
    }

     // CRIAR TURMA
     public function create_team(){
        return view('admin.create_team');
    }
}
