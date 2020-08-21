<?php

namespace Helium\EmailNotifications\Providers;

use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/email.php' => config_path('email.php'),
            __DIR__ . '/../templates' => resource_path('views/email')
        ]);
    }

    public function register()
    {
        parent::register();

        $this->mergeConfigFrom(__DIR__ . '/../config/email.php', 'email');
    }
}