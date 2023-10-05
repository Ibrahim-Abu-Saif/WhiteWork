<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
        // foreach(Permission::all() as $p){
        //     Gate::define($p->code,function($admin) use ($p){
        //         return $admin->role->permissions()->where('code',$p->code)->exists();
        //     });
        // }
        $this->definePermissions();

    }

    private function definePermissions()
    {

        foreach (Permission::all() as $permission) {
            Gate::define($permission->code, function ($admin) use ($permission) {
                return $admin->role->permissions()->where('code', $permission->code)->exists();
            });
        }

    }
}
