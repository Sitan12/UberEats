<?php

namespace App\Providers;

use App\Models\Commande;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
            View::composer('*' ,function($view){
                if(Auth::user())
                $view->with('com',Commande::where('user_id', Auth::user()->id)->get());
                else
                return redirect('login');
            });

            View::composer('*', function($view)
            {
                if(Auth::user())
                $view->with('notify', Notifications::where('recipient', Auth::user()->id)->get());
                else
                return redirect('login');
            });

           


       
      
    }
}
