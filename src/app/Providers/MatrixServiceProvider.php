<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\MatrixService;

/*
|--------------------------------------------------------------------------
| MatrixServiceProvider
|--------------------------------------------------------------------------
|
| Provides Matrix as a Service to perform matrix multiplication operation.
|
*/

class MatrixServiceProvider extends ServiceProvider
{
    /**
     * Registers MatrixService.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MatrixService::class, function ($app) {
            return new MatrixService();
        });
    }
}
