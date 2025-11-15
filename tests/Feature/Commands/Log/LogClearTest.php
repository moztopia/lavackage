<?php

it('clears the log file when --clear is used', function () {
    $logPath = storage_path('logs/laravel.log');
    file_put_contents($logPath, 'Some log content');

    $this->artisan('lavackage:log --clear')
        ->expectsOutput('🐟 Moztopia Lavackage Log Utility')
        ->assertExitCode(0);

    $contents = file_get_contents($logPath);
    expect($contents)->toContain('LOG CLEARED BY OPERATOR');
});
