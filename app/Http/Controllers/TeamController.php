<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\UserTeam;
use App\Models\MessageTeam;
use App\Models\FileMessage;
use App\Models\Hospedagem;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public $hospedagemModel;
    public $isHospedagem;

    public function __construct()
    {
        // Atribua os valores das propriedades no construtor da classe.
        $this->hospedagemModel = new Hospedagem();
        $this->isHospedagem = $this->hospedagemModel->isHospedagem();
    }

    public function index(){
       $teams = DB::table('teams')
        ->join('users_teams', 'teams.id_teams', '=', 'users_teams.id_team')
        ->join('users', 'users.id', '=', 'users_teams.id_user')
        ->where('users_teams.id_user', auth()->id())
        ->select(
            'teams.*',
            'users_teams.*',
            'users.id as user_id',
            'users.name',
            'users.username',
            'users.id'
        )
        ->get();


        return view('user.teams', compact('teams'));
    }

    public function new(){
        return view('admin.create_team');
    }

    public function store(Request $request){
        $utilsController = new UtilsController();

        // validar dados
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $team_code = $utilsController->generateRandomCode(6);// Gera código aleatorio com 6 digitos (A-Z - 0-9)
        $team = Team::where('team_code', $team_code)->get()->count();

        while($team){
            $team_code = $utilsController->generateRandomCode(6);// Gera código aleatorio com 6 digitos (A-Z - 0-9)
        }

        $team = Team::create([
            'id_user' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'team_code' => $team_code,
            'closed' => $request->closed,
            'color' => $request->color,
        ]);

        $user_team = UserTeam::create([
            'id_user' => auth()->user()->id,
            'id_team' => $team->id_teams,
        ]);

        return redirect()->route('teams')->with('success', 'Turma criada');
    }

    function edit($id_team){
        $team = Team::where('id_teams', $id_team)->get()->first();

        if($team){
            return view('admin.edit_teams', ['team' => $team]);
        }

        return view('errors.404');
    }

    public function update(Request $request){
        // validar dados
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);

        $team = Team::where('id_teams', $request->id_team)->get()->first();

        $team->update([
            'id_user' => auth()->user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'closed' => $request->closed,
            'color' => $request->color,
        ]);

        return redirect("/team/$team->team_code")->with('success', 'Turma atualizada');
    }

    public function delete($id_team){
        $team = Team::where('id_teams', $id_team)->get()->first();
        $messages = MessageTeam::where('id_team', $id_team)->get()->all();
        $users_team = UserTeam::where('id_team', $id_team)->get()->all();
        
        foreach($users_team as $user_team){
            $user_team->delete();
        }

        foreach($messages as $message){
            $files = FileMessage::where('id_message_team', $message->id_message_team)->get()->all();

            foreach($files as $file){
                $file->delete();
                $path_file = public_path($file->path_file); //pega caminho da imagem localhost (public/img/img_account)

                //verifica se tem imagem
                if (file_exists($path_file)) {
                    unlink($path_file); // Remove o arquivo
                }

            }

            $message->delete();

        }

        $team->delete();

        return redirect()->route('teams')->with('success', 'Turma excluida');
    }

}
