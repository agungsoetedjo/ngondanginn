<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Daftar policy jika ada
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate untuk memeriksa role 'bendahara'
        Gate::define('isBendahara', function ($user) {
            return $user->role->name === 'bendahara';
        });

        // Gate untuk memeriksa role 'pengelola'
        Gate::define('isPengelola', function ($user) {
            return $user->role->name === 'pengelola';
        });
    }
}
