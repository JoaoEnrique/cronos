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
            return ($user->isAdmin() || $user->id == $team->id_user || $user->id == $userToRemove->id) && $user->id <= $userToRemove->id;
        });
        Gate::define('delete-team', function ($user, $team) {
            return ($user->isAdmin() || $user->id == $team->id_user) && $user->id <= $team->id_user;
        });
        Gate::define('update-team', function ($user, $team) {
            return ($user->isAdmin() || $user->id == $team->id_user) && $user->id <= $team->id_user;
        });
        Gate::define('view-messages', function ($user, $team) {
            $isMember = DB::table('users_teams')
            ->where('id_team', $team->id_teams)
            ->where('id_user', $user->id)
            ->exists();
            return $isMember || $user->isAdmin();
        });
        Gate::define('post-team', function ($user, $team) {
            $isMember = DB::table('users_teams')
            ->where('id_team', $team->id_teams)
            ->where('id_user', $user->id)
            ->exists();

            return (
                ($team->closed && $user->id == $team->id_user && $isMember)
                || (!$team->closed && $isMember)
                || $user->isAdmin()
            );
        });

        Gate::define('edit-team-message', function ($user, $message) {
            return $message->id_user == $user->id || $user->isAdmin();
        });
        Gate::define('delete-team-message', function ($user, $message) {
            return $message->id_user == $user->id || $user->isAdmin();
        });
    }
}
