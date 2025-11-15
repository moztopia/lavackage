<?php

namespace Moztopia\Lavackage\Helpers;

use Illuminate\Console\Command;

class BannerHelper
{
    public static function banner(?Command $command = null): string
    {
        $name = $command?->getName() ?? 'unknown';
        return "<info>🐟 Moztopia Lavackage {$name}</info>";
    }
}
