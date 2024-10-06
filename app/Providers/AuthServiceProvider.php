<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post; // Import the Post model
use App\Policies\PostPolicy; // Import the PostPolicy

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     protected $policies = [
        Post::class => PostPolicy::class,
    ];
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Define your custom gate for updating profile
        Gate::define('edit-update-profile', fn(User $user, User $other) => $user->id == $other->id);

        // Register policies
        Gate::policy(Post::class, PostPolicy::class);
    }
}
