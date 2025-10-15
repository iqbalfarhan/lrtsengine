<?php

namespace Iqbalfarhan\Lrtsengine\Providers;

use Illuminate\Support\ServiceProvider;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsPermission;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsModel;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsStatWidget;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateLrtsView;

class LrtsEngineServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__.'/../../resources/' => resource_path(),
        ], 'lrtsengine-resources');

        $this->commands([
            GenerateLrtsModel::class,
            GenerateLrtsPermission::class,
            GenerateLrtsView::class,
            GenerateLrtsStatWidget::class,
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/lrtsengine.php' => config_path('lrtsengine.php'),
        ], 'lrtsengine-config');
    }
}
