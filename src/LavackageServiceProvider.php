<?php

namespace Moztopia\Lavackage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Moztopia\Lavackage\Console\Commands\HelloCommand;

class LavackageServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Log::info('LavackageServiceProvider booted.');
        $this->commands([
            HelloCommand::class,
        ]);
    }
}
