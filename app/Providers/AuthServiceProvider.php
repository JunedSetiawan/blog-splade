<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use App\Models\Collection;
use App\Models\Post;
use App\Policies\CollectionPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Collection::class => CollectionPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // gate for view-dashboard if has role admin
        Gate::define('view-dashboard', function ($user) {
            return $user->hasRole('admin');
        });
    }
}
