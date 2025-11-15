<?php

namespace Moztopia\Lavackage\Console\Commands;

use Moztopia\Lavackage\Console\LavackageCommand;

class VersionCommand extends LavackageCommand
{
    protected $signature = 'lavackage:version';
    protected $description = 'Display Laravel and Lavackage versions';

    public function handle()
    {
        $this->line($this->banner());
        
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
        $lavackageVersion = $composer['version'] ?? 'dev-develop';

        $this->info('Laravel ' . app()->version());
        $this->info('Lavackage ' . $lavackageVersion);
    }
}
