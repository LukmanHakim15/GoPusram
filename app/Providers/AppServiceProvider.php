<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Paksa Laravel pakai tampilan pagination Bootstrap 5
        Paginator::useBootstrapFive();
    }
}