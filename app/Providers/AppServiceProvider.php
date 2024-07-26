<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::macro('formatUzbekMonth', function () {
            $uzbekMonths = [
                1 => 'Yanvar',
                2 => 'Fevral',
                3 => 'Mart',
                4 => 'Aprel',
                5 => 'May',
                6 => 'Iyun',
                7 => 'Iyul',
                8 => 'Avgust',
                9 => 'Sentabr',
                10 => 'Oktyabr',
                11 => 'Noyabr',
                12 => 'Dekabr'
            ];
    
            $month = $this->month;
            $year = $this->year;
    
            return "{$uzbekMonths[$month]} {$year}";
        });
    }
}
