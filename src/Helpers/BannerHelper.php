<?php

namespace Moztopia\Lavackage\Helpers;

use Illuminate\Console\Command;

class BannerHelper
{
    public static function banner(?Command $command = null): string
    {
        $name = $command?->getName() ?? 'unknown';
        $text = "🐟 Moztopia Lavackage {$name}";
        $border = str_repeat('─', strlen($text) + 2);

        return PHP_EOL
            . "┌{$border}┐" . PHP_EOL
            . "│ {$text} │" . PHP_EOL
            . "└{$border}┘" . PHP_EOL;
    }
}
