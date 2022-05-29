<?php

namespace App\Providers;

use App\Models\MenuMappning;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        // sidebar
        View::composer('*', function($view){
            $view->with('menumaps', MenuMappning::where('role_id', session('sess_role_id'))->get());
        });
    }
}
