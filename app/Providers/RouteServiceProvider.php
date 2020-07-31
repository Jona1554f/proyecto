<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api/v0')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v0/api.php'));
        Route::prefix('api/v1')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v1/api.php'));
        Route::prefix('api/v2')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v2/api.php'));
        Route::prefix('api/v3')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v3/api.php'));
        Route::prefix('api/v4')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v4/api.php'));
        Route::prefix('api/v5')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v5/api.php'));
        Route::prefix('api/v6')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v6/api.php'));
        Route::prefix('api/v7')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v7/api.php'));
        Route::prefix('api/v8')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v8/api.php'));
        Route::prefix('api/v9')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v9/api.php'));
        Route::prefix('api/v10')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v10/api.php'));
        Route::prefix('api/v11')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api/v11/api.php'));
    }
}
