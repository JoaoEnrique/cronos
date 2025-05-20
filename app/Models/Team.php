<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_teams'; //chave primaria

    protected $fillable = [
        'id_user',
        'name', 
        'description',
        'team_code',
        'closed',
        'color'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_teams', 'id_team', 'id_user')
                    ->withPivot('*'); // ou os campos da tabela pivot que você precisa
    }
}
