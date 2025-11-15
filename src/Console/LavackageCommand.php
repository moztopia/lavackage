<?php

namespace Moztopia\Lavackage\Console;

use Illuminate\Console\Command;

abstract class LavackageCommand extends Command
{
    public function banner(): string
    {
        $name = $this->getName() ?? 'unknown';
        $text = "🐟 Moztopia Lavackage {$name}";
        $border = str_repeat('─', strlen($text));

        return PHP_EOL
            . "┌{$border}┐" . PHP_EOL
            . "│ {$text} │" . PHP_EOL
            . "└{$border}┘" . PHP_EOL;
    }
}
