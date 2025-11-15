<?php

it('runs the hello command', function () {
    $this->artisan('lavackage:hello James')
        ->expectsOutput('Hello, James from Lavackage!')
        ->assertExitCode(0);
});
