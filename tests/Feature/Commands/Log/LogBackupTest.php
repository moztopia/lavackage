<?php

it('creates a backup when --backup is used', function () {
    $logPath = storage_path('logs/laravel.log');
    file_put_contents($logPath, 'Backup test content');

    $this->artisan('lavackage:log --backup --clear')
        ->expectsOutput('🐟 Moztopia Lavackage Log Utility')
        ->assertExitCode(0);

    $files = glob(storage_path('logs/laravel.log_*'));
    expect($files)->not->toBeEmpty();
});
