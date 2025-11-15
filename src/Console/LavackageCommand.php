<?php

namespace Moztopia\Lavackage\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Output\OutputInterface;

abstract class LavackageCommand extends Command
{
    public function banner(): string
    {
        $name = $this->getName() ?? 'unknown';
        $text = "🐟 Moztopia Lavackage {$name}";

        return "{$text}" . PHP_EOL;
    }

    public function line($string, $style = null, $verbosity = OutputInterface::VERBOSITY_NORMAL, int $icon = 0): void
    {
        $prefix = $icon === 0 ? '👉' : '👉';
        parent::line("{$prefix} {$string}", $style, $verbosity);
    }
}
