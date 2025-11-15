<?php

use Illuminate\Support\Facades\Artisan;

it('displays both Laravel and Lavackage versions', function () {
    $exitCode = Artisan::call('lavackage:version');
    $output = Artisan::output();

    expect($exitCode)->toBe(0);
    expect($output)->toContain('Laravel');
    expect($output)->toContain('Lavackage');
});
