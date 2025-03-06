<?php

declare(strict_types=1);

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware()
    ->withExceptions()
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('key:generate-encryption-keys')->dailyAt('00:00');
        $schedule->command('logs:clear')->weeklyOn([7])->dailyAt('00:00');
    })
    ->create();
