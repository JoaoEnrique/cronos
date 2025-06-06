<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'pacoca'; // Define a conexão do sistema A
    protected $table = 'users';         // Define a tabela de usuários do sistema A

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'user_name',
        'password',
        'img_account',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Verifica se é admin
    public function isAdmin(){
        return auth()->user()->id <= 5; //verifica se o usuario logado é admin
    }

    public function teams(){
        return $this->belongsToMany(Team::class, 'users_teams', 'id_user', 'id_team')
                    ->withPivot('*'); // ou os campos da tabela pivot que você precisa
    }

}
