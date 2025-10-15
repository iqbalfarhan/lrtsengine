<?php

namespace Iqbalfarhan\Lrtsengine\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsPermission;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsModel;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsResource;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsStatWidget;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsView;
use Iqbalfarhan\Lrtsengine\Console\Commands\LrtsInstall;

class LrtsEngineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge config biar bisa dipakai langsung
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/lrtsengine.php',
            'lrtsengine'
        );

        // Register console commands
        $this->commands([
            LrtsInstall::class,
            GenerateLrtsModel::class,
            GenerateLrtsPermission::class,
            GenerateLrtsView::class,
            GenerateLrtsResource::class,
            GenerateLrtsStatWidget::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish config
        $this->publishes([
            __DIR__ . '/../../config/lrtsengine.php' => config_path('lrtsengine.php'),
        ], 'lrtsengine-config');

        // Publish resources (views, assets, dsb)
        $this->publishes([
            __DIR__ . '/../../resources/' => resource_path(),
        ], 'lrtsengine-resources');

        $this->publishes([
            __DIR__ . '/../../app/Http/Controllers/Controller.php' => app_path('Http/Controllers/Controller.php'),
        ], 'lrtsengine-controller');

        // Kalau lo punya views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lrtsengine');

        // Kalau lo punya routes
        if (file_exists(__DIR__ . '/../../routes/web.php')) {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        }

        // Kalau lo punya migrations
        if (is_dir(__DIR__ . '/../../database/migrations')) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }

        Artisan::call('migrate');
    }
}
