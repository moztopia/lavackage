<?php

namespace Moztopia\Lavackage\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class LogCommand extends Command
{
    protected $signature = 'lavackage:log
                            {--clear : Clear the log file}
                            {--backup : Backup the log before clearing}
                            {--threshold= : Minimum log size in MB before clearing}
                            {--max-backups=0 : Maximum number of backup files to keep (0 = unlimited)}';

    protected $description = 'Moztopia Lavackage log utility with clear, backup, threshold, and max-backups options';

    public function handle(): void
    {
        $this->line('<info>🐟 Moztopia Lavackage Log Utility</info>');

        $verbose = $this->getOutput()->getVerbosity();
        $logPath = storage_path('logs/laravel.log');

        if (! file_exists($logPath)) {
            $this->warn('⚠️ Log file does not exist.');
            return;
        }

        $thresholdMb = $this->option('threshold');
        if ($thresholdMb !== null) {
            $fileSizeMb = round(filesize($logPath) / (1024 * 1024), 2);
            if ($fileSizeMb < (float) $thresholdMb) {
                $this->info("ℹ️ Log size is {$fileSizeMb} MB, below threshold of {$thresholdMb} MB. No action taken.");
                return;
            }
        }

        if ($this->option('backup')) {
            $timestamp = Carbon::now()->format('Ymd-His');
            $backupPath = storage_path("logs/laravel.log_{$timestamp}");

            if (copy($logPath, $backupPath)) {
                if ($verbose >= 32) {
                    $this->info("📦 Backup created: {$backupPath}");
                }

                $maxBackups = (int) $this->option('max-backups');
                if ($maxBackups > 0) {
                    $this->enforceMaxBackups($maxBackups);
                }
            } else {
                $this->error("❌ Failed to create backup.");
                return;
            }
        }

        if ($this->option('clear')) {
            file_put_contents($logPath, '');
            Log::warning('LOG CLEARED BY OPERATOR at ' . Carbon::now()->toDateTimeString());

            if ($verbose >= 32) {
                $this->info('✅ Laravel log file cleared and operator entry added!');
            }
            if ($verbose >= 64) {
                $this->line('Verbose level 2: Detailed clearing process completed.');
            }
            if ($verbose >= 128) {
                $this->line('Verbose level 3: Full diagnostic output available.');
            }
        }
    }

    protected function enforceMaxBackups(int $maxBackups): void
    {
        $backupFiles = glob(storage_path('logs/laravel.log_*'));
        if (count($backupFiles) > $maxBackups) {
            usort($backupFiles, fn($a, $b) => filemtime($a) <=> filemtime($b));
            $filesToDelete = array_slice($backupFiles, 0, count($backupFiles) - $maxBackups);
            foreach ($filesToDelete as $file) {
                @unlink($file);
                $this->warn("🗑️ Deleted old backup: {$file}");
            }
        }
    }
}
