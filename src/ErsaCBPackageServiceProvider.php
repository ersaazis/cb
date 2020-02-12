<?php namespace Ersaazis\CB\Providers;

use Ersaazis\CB\commands\DeveloperCommand;
use Ersaazis\CB\commands\Generate;
use Ersaazis\CB\commands\MigrateData;
use Ersaazis\CB\controllers\scaffolding\singletons\ColumnSingleton;
use Ersaazis\CB\helpers\MiscellanousSingleton;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Ersaazis\CB\commands\Install;
use App;

class ErsaCBPackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {        

        // Register views
        $this->loadViewsFrom(__DIR__.'/views', 'crudbooster');
        $this->loadViewsFrom(__DIR__.'/types', 'types');
        $this->loadTranslationsFrom(__DIR__."/localization","cb");

        // Publish the files
        $this->publishes([__DIR__.'/configs/crudbooster.php' => config_path('crudbooster.php')],'cb_config');
        $this->publishes([__DIR__.'/database' => base_path('database')],'cb_migration');
        $this->publishes([__DIR__.'/templates/CBHook.stub'=> app_path('Http/CBHook.php')],'cb_hook');
        $this->publishes([__DIR__ . '/assets' =>public_path('cb_asset')],'cb_asset');

        // Override Local FileSystem
        Config::set("filesystems.disks.local.root", cbConfig("LOCAL_FILESYSTEM_PATH", public_path("storage")));
                    
        require __DIR__.'/validations/validation.php';        
        require __DIR__.'/routes.php';

        $this->registerTypeRoutes();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {                                   
        require __DIR__.'/helpers/Helper.php';

        // Singletons
        $this->app->singleton('crudbooster', function ()
        {
            return true;
        });

        // Column register singleton
        $this->app->singleton('ColumnSingleton', ColumnSingleton::class);

        // Miscellanous Singleton
        $this->app->singleton("MiscellanousSingleton", MiscellanousSingleton::class);


        // Register Commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Install::class,
                Generate::class,
                DeveloperCommand::class,
                MigrateData::class
            ]);
        }

        // Merging configuration
        $this->mergeConfigFrom(__DIR__.'/configs/crudbooster.php','crudbooster');

        // Register additional library
        $this->app->register('Intervention\Image\ImageServiceProvider');
    }

    private function registerTypeRoutes() {
        $routes = rglob(__DIR__.DIRECTORY_SEPARATOR."types".DIRECTORY_SEPARATOR."Route.php");
        foreach($routes as $route) {
            require $route;
        }
    }



}
