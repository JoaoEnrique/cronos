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
    public function createAccount(Request $request){
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
    public function viewAccount($user_name){
        $user = User::where('user_name', $user_name)->get()->first();

        if($user){
            return view('user.account', compact('user'));
        }

        return redirect()->route('page_not_found');
    }
    
    // ATUALIZAR CONTA
    public function updateAccount(Request $request){
        try{
            // validar dados
            $dados = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(auth()->id())],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::where('username', $request->user_name)->get()->first();

            $user->update([
                'name' => $request->name,
                'username' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Se estiver hospedado
            if($this->isHospedagem){
                return redirect('/' . $user->user_name)->with('success', 'Conta atualizada com sucesso!');
            }else{// Se não estiver hospedado
                return redirect('/' . $user->user_name)->with('success', 'Conta atualizada com sucesso!');
            }
        }catch(Exception $e){
            return redirect('/' . $user->user_name)->with('danger', 'Não foi possivel atualizar conta! Tente novamente mais tarde');
        }
    }

    //APAGAR CONTA 
    public function deleteAccount($id){
        try{
            $id_user_logged =  auth()->user()->id; //id do usuario logado

            //Verifica se é admin ou student
            $student = Student::where('id_user', $id)->first();
            $cont_admins = Admin::get()->count();
            $admin = Admin::where('id_user', $id)->first();
            
            // verifica se é aluno ou admin e apaga
            if($admin){
                if($cont_admins >=2){
                    $admin->delete();
                }else{
                    return redirect()->route('admin.list_admins')->with('danger', 'Você precisa deixar no mínimo 1 administrador');
                }
                
            }else{
                if($student){
                    $student->delete();
                }
            }

            // remove usuario das turmas
            $users_teams = UserTeam::where('id_user', $id)->get();
            foreach($users_teams as $user_team){
                $user_team->delete();
            }

            $user = User::find($id); //APAGA USUÁRIO
            if($user){
                $user->delete();
            }

            //pega caminho da imagem do quiz
            if($this->isHospedagem){ //se estiver na hospedagem
                $img_user_Path = public_path('../img/img_account/' . $id . '.png'); //pega caminho da imagem hospedagem (img/img_account)
            }else{//se não estiver na hospedagem
                $img_user_Path = public_path('img/img_account/' . $id . '.png'); //pega caminho da imagem localhost (public/img/img_account)
            }

            //verifica se tem imagem
            if (file_exists($img_user_Path)) {
                unlink($img_user_Path); // Remove o arquivo
            }
    
            // Caso o usuário logado apague a propria conta
            if($id_user_logged == $id){
                return redirect()->route('login')->with('success', 'Sua conta foi excluida');
            }
            
            // Caso um Admin apague um aluno ou outro admin
            if($admin){ // se for admin
                return redirect()->route('admin.list_admins')->with('success', 'A conta do administrador foi deletada');
            }else{ //se for aluno
                return redirect()->route('admin.list_students')->with('success', 'A conta do usuário foi deletada');
            }

        }catch(Exception $e){
            return redirect()->route('admin.list_admins')->with('danger', 'Não foi possivel apagar conta');
        }
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

    // ATUALIZAR CONTA
    public function updateImgAccount(Request $request){

        $request->validate([
            'img' => ['required']
        ]);

        $user = User::find(auth()->user()->id); //usuario logado

        // CASO TENHA IMAGEM NO POST
        if($request->hasFile('img') ){
            if($request->file('img')->isValid()){
                $img = $request->img; //imagem do usuario
                $imgName = auth()->user()->id . ".png"; //nome da imagem (id_user.png)

                if($this->isHospedagem){ //se estiver na hospedagem
                    $path = public_path('../img/img_account'); //caminho para salvar imagem hospedagem (img/img_account)
                }else{//se não estiver na hospedagem
                    $path = public_path('img/img_account'); //caminho para salvar imagem localhost (public/img/img_account)
                }

                $request->img->move($path, $imgName); //salva imagem

                //atualiza caminho da imagem no banco
                $user->update([
                    'img' => "img/img_account/" . $imgName,
                ]);

                return redirect('/' . $user->user_name)->with('success', 'Imagem alterada com sucesso!');
            }else{
                return redirect('/' . $user->user_name)->with('danger', 'Erro ao alterar imagem! Tente novamente mais tarde');
            }
        }
            // return redirect()->route('account.edit')->with('danger-img', 'Clique na sua imagem abaixo para trocar a foto de perfil');
    }

    public function getFilesByIdMessage($id_message_team){
        return FileMessage::where('id_message_team', $id_message_team)->get();
    }

    //atualizar mensagem da turma
    public function updateMessage(Request $request){
        try{
            $dados = $request->validate([
                'message' => ['required'],
            ]);

            $message = MessageTeam::where('id_message_team', $request->id_message_team)->get()->first();

            $message ->update([
                'text' => $request->message,
            ]);

            return redirect()->back()->with('success', 'Mensagem atualizada');
        }catch(Exception $e){
            return redirect()->back()->with('danger', 'Não foi possivel atualizar mensagem. Tente novamente mais tarde');
        }
    }

    //apagar mensagem da turma
    public function deleteMessage($id_message_team){
        try{
            $files = FileMessage::where('id_message_team', $id_message_team)->get()->all();

            foreach($files as $file){
                $file->delete();

                //pega caminho do arquivo
                $path_file = public_path($file->path_file); //pega caminho da imagem localhost (public/img/img_account)
                //$img_user_Path = public_path('../img/img_account/' . $id . '.png'); //pega caminho da imagem hospedagem (img/img_account)

                //verifica se tem imagem
                if (file_exists($path_file)) {
                    unlink($path_file); // Remove o arquivo
                }

            }

            $message = MessageTeam::where('id_message_team', $id_message_team)->get()->first()->delete();

            return redirect()->back()->with('success', 'Mensagem apagada');
        }catch(Exception $e){
            return redirect()->back()->with('danger', 'Não foi possivel apagar mensagem. Tente novamente mais tarde');
        }
    }

    // Enviar mensagem de contato
    public function SendContact(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'max:13',],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:255'],
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Mensagen enviada com sucesso');
    }
}
