<?php

namespace App\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Student;
use App\Models\User;
use App\Models\Team;
use App\Models\MessageTeam;
use App\Models\UserTeam;
use App\Models\Contact;
use App\Models\FileMessage;
use App\Models\Hospedagem;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // VERIFICA SE É ADMIN
    public function isAdmin($id_user){
        return $id_user <= 5;
    }

    public function view_users_teams($id_team){
        $teams = DB::table('teams')
            ->join('users_teams', 'teams.id_teams', '=', 'users_teams.id_team')
            ->where('users_teams.id_team', $id_team)
            ->select(
                'users_teams.id_user',
                'users_teams.id_team',
                'teams.name as team_name',
                'teams.id_teams as team_id'
            )
            ->limit(5)
            ->get();

        $userIds = $teams->pluck('id_user')->unique()->toArray();

        $users = DB::connection('pacoca')->table('users')
            ->whereIn('id', $userIds)
            ->get()
            ->keyBy('id');

        $teams = $teams->map(function ($team) use ($users) {
            $user = $users[$team->id_user] ?? null;

            return (object) [
                'id'     => $user->id,
                'team_id'     => $team->team_id,
                'team_name'   => $team->team_name,
                'user_id'     => $user->id ?? null,
                'user_name'   => $user->user_name ?? null,
                'name'        => $user->name ?? null,
                'img_account' => $user->img_account ?? null,
            ];
        });

        return $teams;
    }

    public function count_users_teams($id_team){
        $count_users = UserTeam::where('id_team', $id_team)->get()->count();

        return $count_users;
    }
}
