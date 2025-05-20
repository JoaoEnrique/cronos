<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Team;
use App\Models\MessageTeam;
use App\Models\FileMessage;
use App\Models\UserTeam;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

use App\Models\Hospedagem;



class UserController extends Controller
{
    //  Verifica se está na hospedagem para mudar caminhos das imagens no banco
    public $hospedagemModel;
    public $isHospedagem;

    public function __construct(){
        // Atribua os valores das propriedades no construtor da classe.
        $this->hospedagemModel = new Hospedagem();
        $this->isHospedagem = $this->hospedagemModel->isHospedagem();
    }

    // VERIFICA SE É ADMIN
    public function isAdmin($id_user){
        $admin = Admin::where('id_user', $id_user)->get()->count();
        return $admin;
    }

    // CRIA USUÁRIO - Aluno
    public function register(Request $request){
        try{
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'user_name' => [
                    'required',
                    'string',
                    'max:20',
                    Rule::unique('pacoca.users', 'user_name'),
                    'regex:/^[a-zA-Z][a-zA-Z0-9_]*$/'
                ],
                'email' => ['required', 'string', 'email', 'max:50', Rule::unique('pacoca.users', 'email')],
                'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'max:50', 'min:8'],
                'termos' => ['required'],
            ]);
    

            $dados = $request->only(['name', 'user_name', 'email', 'phone', 'password', 'site', 'biography', 'sexo', 'birth_date']);
            $dados['password'] = Hash::make($dados['password']);

            $user = User::create($dados);
            Auth::login($user);

            if($user){
                return redirect()->route('login')->with('success', 'Conta criada com sucesso');
            }
            
            return redirect()->route('login')->with('danger', 'Conta criada com erro');

        } catch (ValidationException $e) {
            throw $e;
        }catch(\Exception $e){
            return redirect()->route('register')->with('danger', 'Erro ao criar conta! Tente novamente mais tarde: ' . $e->getMessage());
        }
    }

    // ABRIR CONTA
    public function account($user_name){
        $user = User::where('user_name', $user_name)->get()->first();

        if($user){
            return view('user.account', compact('user'));
        }

        return redirect()->route('page_not_found');
    }
    
    // FAZER LOGIN
    public function login(Request $request) {
        // validar dados
        $dados = $request->validate([
            'login' => ['required'],
            'password' => ['required']
        ]);
    
        // Verificar se o campo fornecido é um email ou um nome de usuário
        $fieldType = filter_var($dados['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';
    
        // Ajustar os dados para autenticação
        $credentials = [
            $fieldType => $dados['login'], // Usa o tipo de campo detectado
            'password' => $dados['password'],
        ];
    
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('');
        }
    
        return back()->withErrors([
            'password' => 'O email e/ou senha estão inválidos'
        ])->withInput();
    
        //email ou senha errado
        return back()->withErrors(['password' => 'O email e/ou senha são inválidos'])->withInput();
    }

    // SAIR DA CONTA
    public function logout(Request $request){
        Auth::logout(); //sai da conta

        //remove sessão
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Você saiu da sua conta');
    }

    public function getFilesByIdMessage($id_message_team){
        return FileMessage::where('id_message_team', $id_message_team)->get();
    }
}
