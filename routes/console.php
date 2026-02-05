<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Schedule Digitail Sync setiap jam 00:00 WIB
Schedule::command('digitail:sync')
    ->dailyAt('00:00')
    ->timezone('Asia/Jakarta')
    ->appendOutputTo(storage_path('logs/digitail-sync-cron.log'));