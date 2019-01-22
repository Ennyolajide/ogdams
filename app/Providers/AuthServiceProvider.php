<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->before(function ($user, $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        $gate->define('isAdmin', function($user){
            return $user->role == 'admin';
        });

        $gate->define('isAdmin', function($user){
            return $user->role == 'moderator';
        });

        $gate->define('isAdmin', function($user){
            return $user->role == 'reseller';
        });

        $gate->define('isAdmin', function($user){
            return $user->role == 'customer';
        });


    }
}
