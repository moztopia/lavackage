<?php

namespace Moztopia\Lavackage\Console;

use Illuminate\Console\Command;

abstract class LavackageCommand extends Command
{
    public function banner(): string
    {
        $name = $this->getName() ?? 'unknown';
        $text = "🐟 Moztopia Lavackage {$name}";

        return "{$text}" . PHP_EOL;
    }

    public function line($string, $style = null, $verbosity = self::VERBOSITY_NORMAL, int $icon = 0): void
    {
        $prefix = $icon === 0 ? '👉' : '👉';
        
        parent::line("{$prefix} {$string}", $style, $verbosity);
    }
}
