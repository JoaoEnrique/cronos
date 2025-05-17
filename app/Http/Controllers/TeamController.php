<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\UserTeam;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
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
}
