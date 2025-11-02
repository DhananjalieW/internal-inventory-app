<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
{
   Blade::if('role', function (string $roles) {
    if (! auth()->check()) return false;
    $allowed = array_map('trim', explode('|', $roles));
    return in_array(auth()->user()->role, $allowed, true);
    });
}
}
