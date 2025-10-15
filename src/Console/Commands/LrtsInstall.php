<?php

namespace Iqbalfarhan\Lrtsengine\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LrtsInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lrts:install';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install iqbalfarhan/lrtsengine package, include config, resources, and vendor publish';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // IqbaFarhan/LrtsEngine
        Artisan::call('vendor:publish', [
          '--provider' => 'Iqbalfarhan\Lrtsengine\Providers\LrtsEngineServiceProvider',
          '--tag' => 'lrtsengine-config'
        ]);

        Artisan::call('vendor:publish', [
          '--provider' => 'Iqbalfarhan\Lrtsengine\Providers\LrtsEngineServiceProvider',
          '--tag' => 'lrtsengine-resources'
        ]);

        // Spatie/MediaLibrary

        Artisan::call('vendor:publish', [
          '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
          '--tag' => 'medialibrary-migrations'
        ]);

        Artisan::call('vendor:publish', [
          '--provider' => 'Spatie\MediaLibrary\MediaLibraryServiceProvider',
          '--tag' => 'medialibrary-config'
        ]);

        // Spatie/Permission
        Artisan::call('vendor:publish', [
          '--provider' => 'Spatie\Permission\PermissionServiceProvider',
        ]);
    }
    
}
