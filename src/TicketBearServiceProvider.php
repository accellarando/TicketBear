<?php

namespace Accellarando\TicketBear;

use Illuminate\Support\ServiceProvider;
use accellarando\ticketbear\Console\InstallTicketBear;

class TicketBearServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('\accellarando\ticketbear\IssueControllerBase');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        //Migrations
        $this->loadMigrationsFrom(__DIR__.'/migrations/');
        //Views
        $this->loadViewsFrom(__DIR__.'/views','ticketbear');
        //Allow user to publish views to resources/views/
        $this->publishes([__DIR__.'/views/' => base_path('resources/views/accellarando/ticketbear')]);
        //ticketbear:install artisan command
        if($this->app->runningInConsole())
            $this->commands([InstallTicketBear::class,]);
    }
}
