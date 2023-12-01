<?php

namespace App\Providers;

//use App\Models\User;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */

    public function boot(): void
    {
        Gate::define('admin', function (User $user){
            return $user->access_level ===  'admin';
        });

        Gate::define('compras', function (User $user){
            return $user->access_level ===  'compras';
        });

        Gate::define('filipe', function (User $user){
            return $user->access_level ===  'filipe';
        });

        Gate::define('bruno', function (User $user){
            return $user->access_level ===  'bruno';
        });

        Gate::define('isma', function (User $user){
            return $user->access_level ===  'isma';
        });

        Gate::define('contato', function (User $user){
            return $user->access_level ===  'contato';
        });

        Gate::define('clientes', function (User $user){
        return in_array($user->access_level, ['admin', 'filipe', 'bruno','isma','contato']);
        });

        Gate::define('contratos', function (User $user){
            return in_array($user->access_level, ['admin', 'filipe']);
        });

        Gate::define('veiculos', function (User $user){
            return in_array($user->access_level, ['admin', 'filipe', 'bruno', 'isma']);
        });

        Gate::define('pagarcontas', function (User $user){
            return in_array($user->access_level, ['admin', 'filipe']);
        });
        Gate::define('contasapagar', function (User $user){
            return in_array($user->access_level, ['admin', 'compras', 'filipe','bruno','isma','contato']);
        });

        Gate::define('notasfiscais', function (User $user){
            return in_array($user->access_level, ['admin', 'filipe', 'bruno','contato']);
        });

        Gate::define('fluxocaixa', function (User $user){
            return in_array($user->access_level, ['admin', 'filipe']);
        });

        Gate::define('fluxocaixacadastro', function (User $user){
            return in_array($user->access_level, ['admin', 'bruno','contato','filipe','compras']);
        });

        Gate::define('motoristas', function (User $user){
            return in_array($user->access_level, ['admin', 'bruno','isma']);
        });

        Gate::define('ordemservico', function (User $user){
            return in_array($user->access_level, ['admin', 'filipe']);
        });


    }
}
