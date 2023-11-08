<?php

namespace App\Providers;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        View::composer('layouts.page-layout', function ($view) {
            // Verifique se o usuário está autenticado antes de acessar os dados do usuário
            if (auth()->check()) {
                // Adicione os dados do usuário à view
                $view->with('user', auth()->user());
            }
        });

        Blade::directive('route', function ($expression) {
            return "<?php echo route({$expression}); ?>";
        });
    }
}
