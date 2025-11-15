<?php

namespace Moztopia\Lavackage\Console\Commands;

use Illuminate\Console\Command;

class VersionCommand extends Command
{
    protected $signature = 'lavackage:version';
    protected $description = 'Display Laravel and Lavackage versions';

    public function handle()
    {
        $composer = json_decode(file_get_contents(base_path('composer.json')), true);
        $lavackageVersion = $composer['version'] ?? 'dev-develop';

        $this->info('Laravel ' . app()->version());
        $this->info('Lavackage ' . $lavackageVersion);
    }
}
