<?php

namespace App\Providers;
use App\Permission;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class RolesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      /*  try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }*/






        Blade::directive('role', function ($roles) {
            return "<?php if(auth()->check() && auth()->user()->hasRole($roles)) : ?>"; 
        });

        Blade::directive('endrole', function ($roles) {
            return "<?php endif; ?>"; 
        });
    }
}