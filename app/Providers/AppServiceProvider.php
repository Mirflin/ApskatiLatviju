<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FooterContents;

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
        view()->composer('*', function($view){
            $view_name = str_replace('.', '-', $view->getName());
            view()->share('view_name', $view_name);

            // add footer to all; and check if footerContent exist
            $footer = FooterContents::first() ?? new FooterContents();
            view()->share('footer', $footer);
        });
    }
}
