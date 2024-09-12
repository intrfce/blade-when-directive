<?php

namespace Intrfce\InertiaComponents\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Intrfce\InertiaComponents\Services\RouteRegistrationProxy;
use Intrfce\InertiaComponents\Singletons\RegisteredRouteGlobal;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class BladeWhenDirectiveProvider extends ServiceProvider
{
    public function register(): void
    {

        $this->app->singleton(RegisteredRouteGlobal::class);

        Route::macro('inertia', function ($path, string $classComponent) {

            if (! class_exists($classComponent)) {
                throw new RouteNotFoundException("Class '{$classComponent}' not found.");
            }

            return (new RouteRegistrationProxy($path, $classComponent));
        });
    }

    public function boot(): void {



    }
}
