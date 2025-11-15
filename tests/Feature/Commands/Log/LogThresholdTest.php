<?php

it('respects threshold option', function () {
    $logPath = storage_path('logs/laravel.log');
    file_put_contents($logPath, str_repeat('x', 1024)); // ~1 KB

    $this->artisan('lavackage:log --clear --threshold=1')
        ->expectsOutput('🐟 Moztopia Lavackage Log Utility')
        ->expectsOutput('ℹ️ Log size is 0 MB, below threshold of 1 MB. No action taken.')
        ->assertExitCode(0);

    expect(file_get_contents($logPath))->not->toBe('');
});
