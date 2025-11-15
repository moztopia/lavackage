<?php

namespace Moztopia\Lavackage\Console;

use Illuminate\Console\Command;

abstract class LavackageCommand extends Command
{
    public function handle(): int
    {
        $this->banner();

        return self::SUCCESS;
    }

    protected function banner(): void
    {
        $name = $this->getName() ?? 'unknown';
        $text = "Moztopia Lavackage {$name}";

        $this->info($text);
        $this->newLine();

        return;
    }
}
