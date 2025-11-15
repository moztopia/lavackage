<?php

use Illuminate\Support\Facades\Artisan;

it('prints a Lavackage version identifier', function () {
    $exitCode = Artisan::call('lavackage:version');
    $output = Artisan::output();

    expect($exitCode)->toBe(0);
    expect($output)->toMatch('/Lavackage (version \d+\.\d+\.\d+|dev-[a-z]+)/');
});
