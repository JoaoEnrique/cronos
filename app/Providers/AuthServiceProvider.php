<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('remover-user', function ($user, $team, $userToRemove) {
            return ($user->id <= 5 || $user->id == $team->id_user) && $user->id >= $userToRemove->id;
        });
        Gate::define('post-team', function ($user, $team) {
            $isMember = DB::table('users_teams')
            ->where('id_team', $team->id_teams)
            ->where('id_user', $user->id)
            ->exists();


            return (
                ($team->closed && $user->id == $team->id_user && $isMember)
                || (!$team->closed && $isMember)
            );
        });
    }
}
