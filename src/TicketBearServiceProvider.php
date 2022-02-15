<?php

namespace Accellarando\TicketBear;

use Illuminate\Support\ServiceProvider;

class TicketBearServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('\Accellarando\TicketBear\IssueController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations/');
        $this->loadViewsFrom(__DIR__.'/views','ticketbear');
        $this->publishes([__DIR__.'/views/' => base_path('resources/views/accellarando/ticketbear')]);
    }
}
