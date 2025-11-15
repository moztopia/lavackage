<?php

it('runs the hello command with parameter as James', function () {
    $this->artisan('lavackage:hello James')
        ->expectsOutput('Hello James! ... from Lavackage!')
        ->assertExitCode(0);
});

it('runs the hello command with no parameter', function () {
    $this->artisan('lavackage:hello')
        ->expectsOutput('Hello World! ... from Lavackage!')
        ->assertExitCode(0);
});
