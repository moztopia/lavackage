<?php

namespace Moztopia\Lavackage\Console\Commands;

use Moztopia\Lavackage\Console\LavackageCommand;
use Illuminate\Support\Facades\Log;

class HelloCommand extends LavackageCommand
{
    protected $signature = 'lavackage:hello {name?}';
    protected $description = 'Say hello from Lavackage and log the event';

    public function handle(): int
    {
        $this->line($this->banner());

        $name = $this->argument('name') ?? 'World';
        $this->info("Hello {$name}! ... from Lavackage!");
        
        Log::info("lavackage:hello executed", ['name' => $name]);

        return self::SUCCESS;
    }
}
