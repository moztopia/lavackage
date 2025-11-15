<?php

namespace Moztopia\Lavackage;

use Illuminate\Support\ServiceProvider;
use Moztopia\Lavackage\Console\Commands\HelloCommand;
use Moztopia\Lavackage\Console\Commands\LogCommand;

class LavackageServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            HelloCommand::class,
            LogCommand::class,
        ]);
    }

    public function boot()
    {
        //
    }
}
