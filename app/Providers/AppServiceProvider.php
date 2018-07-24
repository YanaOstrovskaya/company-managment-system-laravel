<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.nav',function($view){
            if(isset(Auth::user()->company_id)){
                $logo = Auth::user()->company->logo;
            }
            else{
                $logo = 'default-logo.png';
            }
            $view->with('logo', $logo);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
