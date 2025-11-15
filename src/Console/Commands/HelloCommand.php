<?php

namespace Moztopia\Lavackage\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Moztopia\Lavackage\Helpers\BannerHelper;

class HelloCommand extends Command
{
    protected $signature = 'lavackage:hello {name?}';
    protected $description = 'Say hello from Lavackage and log the event';

    public function handle(): int
    {
        $this->line(BannerHelper::banner($this));

        $name = $this->argument('name') ?? 'World';
        $this->info("Hello {$name}! ... from Lavackage!");
        
        Log::info("lavackage:hello executed", ['name' => $name]);

        return self::SUCCESS;
    }
}
