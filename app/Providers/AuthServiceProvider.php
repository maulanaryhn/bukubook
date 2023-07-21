<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // list user hanya untuk roles admin
        Gate::define('list-user', fn ($user) => $user->roles === 'ADMIN');
        Gate::define('create-user', fn ($user) => $user->roles === 'ADMIN');
        // permission untuk book
        Gate::define('list-book', fn ($user) => in_array($user->roles, ['ADMIN', 'USER']));
        Gate::define('create-book', fn ($user) => $user->roles === 'ADMIN');
    }
}
