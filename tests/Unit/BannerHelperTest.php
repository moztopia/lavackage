<?php

use Moztopia\Lavackage\Helpers\BannerHelper;
use Illuminate\Console\Command;

class DummyCommand extends Command
{
    protected $signature = 'lavackage:dummy';
    protected $description = 'A dummy command for testing';
}

it('returns banner with command name', function () {
    $command = new DummyCommand;
    $banner = BannerHelper::banner($command);

    expect($banner)->toBe('<info>🐟 Moztopia Lavackage lavackage:dummy</info>');
});

it('returns banner with unknown when no command provided', function () {
    $banner = BannerHelper::banner();

    expect($banner)->toBe('<info>🐟 Moztopia Lavackage unknown</info>');
});
