<?php

namespace Iqbalfarhan\Lrtsengine\Providers;

use App\Console\Commands\GeneratePermissionCommand;
use Illuminate\Support\ServiceProvider;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateAModel;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateRModel;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateRView;
use Iqbalfarhan\Lrtsengine\Console\Commands\GenerateStatWidget;

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
            GenerateAModel::class,
            GeneratePermissionCommand::class,
            GenerateRModel::class,
            GenerateRView::class,
            GenerateStatWidget::class,
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
