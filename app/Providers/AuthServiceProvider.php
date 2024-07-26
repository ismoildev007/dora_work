<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Staff;
use App\Models\User;
use App\Policies\ActivityPolicy;
use App\Policies\ClientPolicy;
use App\Policies\StaffPolicy;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class,
        Client::class => ClientPolicy::class,
        Staff::class => StaffPolicy::class,
        Activity::class => ActivityPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 0===Admin , 1===Manager , 2===User

        Gate::define('view-user', function ($user) {
            return in_array($user->role, ['admin']); // Work ni ko'rish mumkin bo'lgan rollar
        });
        Gate::define('view-manager', function ($user) {
            return in_array($user->role, ['admin']); // Work ni ko'rish mumkin bo'lgan rollar
        });
        Gate::define('view-client', function ($user) {
            return in_array($user->role, ['admin', 'manager']); // Work ni ko'rish mumkin bo'lgan rollar
        });
        Gate::define('view-activity', function ($user) {
            return in_array($user->role, ['admin', 'manager', 'staff']); // Work ni ko'rish mumkin bo'lgan rollar
        });
        Gate::define('view-project', function ($user) {
            return in_array($user->role, ['admin', 'staff', 'manager']); // Work ni ko'rish mumkin bo'lgan rollar
        });
        Gate::define('view-staff', function ($user) {
            return in_array($user->role, ['admin', 'manager']); // Work ni ko'rish mumkin bo'lgan rollar
        });
        Gate::define('view-department', function ($user) {
            return in_array($user->role, ['admin']); // Work ni ko'rish mumkin bo'lgan rollar
        });
        Gate::define('view-report', function ($user) {
            return in_array($user->role, ['admin']); // Work ni ko'rish mumkin bo'lgan rollar
        });
//        Gate::define('view-notification', function ($user) {
//            return in_array($user->role, [0, 1, 2]); // Notification ni ko'rish mumkin bo'lgan rollar
//        });
//        Gate::define('view-amount', function ($user) {
//            return in_array($user->role, [0]); // Amount ni ko'rish mumkin bo'lgan rollar
//        });
//        Gate::define('view-employee', function ($user) {
//            return in_array($user->role, [0, 1]); // Work ni ko'rish mumkin bo'lgan rollar
//        });
//        Gate::define('view-department', function ($user) {
//            return in_array($user->role, [0]); // Work ni ko'rish mumkin bo'lgan rollar
//        });
//        Gate::define('view-manager', function ($user) {
//            return in_array($user->role, [0]); // Work ni ko'rish mumkin bo'lgan rollar
//        });
//        Gate::define('view-status', function ($user) {
//            return in_array($user->role, [0, 1, 2]); // Work ni ko'rish mumkin bo'lgan rollar
//        });
    }
}
