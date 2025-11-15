<?php

it('creates a backup when --backup is used', function () {
    $logPath = storage_path('logs/laravel.log');
    file_put_contents($logPath, 'Backup test content');

    $this->artisan('lavackage:log --backup --clear')
        ->assertExitCode(0);

    $files = glob(storage_path('logs/laravel.log_*'));
    expect($files)->not->toBeEmpty();
});

it('clears the log file when --clear is used', function () {
    $logPath = storage_path('logs/laravel.log');
    file_put_contents($logPath, 'Some log content');

    $this->artisan('lavackage:log --clear')
        ->assertExitCode(0);

    $contents = file_get_contents($logPath);
    expect($contents)->toContain('LOG CLEARED BY OPERATOR');
});

it('enforces max-backups by deleting oldest backups', function () {
    $logPath = storage_path('logs/laravel.log');
    File::put($logPath, 'dummy log content');

    foreach (range(1, 5) as $i) {
        $backupPath = storage_path("logs/laravel.log_20250101-000{$i}");
        File::put($backupPath, "backup {$i}");
        touch($backupPath, time() - (1000 * $i));
    }

    $exitCode = Artisan::call('lavackage:log', [
        '--backup' => true,
        '--max-backups' => 3,
    ]);

    expect($exitCode)->toBe(0);

    $backups = glob(storage_path('logs/laravel.log_*'));
    expect(count($backups))->toBe(3);

    foreach ($backups as $file) {
        $mtime = filemtime($file);
        expect($mtime)->toBeGreaterThan(time() - 4000);
    }
});

it('does not delete backups when under max-backups limit', function () {
    File::cleanDirectory(storage_path('logs'));
    $logPath = storage_path('logs/laravel.log');
    File::put($logPath, 'dummy log content');

    foreach (range(1, 2) as $i) {
        $backupPath = storage_path("logs/laravel.log_20250102-000{$i}");
        File::put($backupPath, "backup {$i}");
        touch($backupPath, time() - (1000 * $i));
    }

    $exitCode = Artisan::call('lavackage:log', [
        '--backup' => true,
        '--max-backups' => 5,
    ]);

    expect($exitCode)->toBe(0);

    $backups = glob(storage_path('logs/laravel.log_*'));
    expect(count($backups))->toBe(3);
});

it('respects threshold option', function () {
    $logPath = storage_path('logs/laravel.log');
    file_put_contents($logPath, str_repeat('x', 1024));

    $this->artisan('lavackage:log --clear --threshold=1')
        ->expectsOutput('ℹ️ Log size is 0 MB, below threshold of 1 MB. No action taken.')
        ->assertExitCode(0);

    expect(file_get_contents($logPath))->not->toBe('');
});
