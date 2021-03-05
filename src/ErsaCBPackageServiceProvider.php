<?php namespace ersaazis\cb;

use ersaazis\cb\commands\DeveloperCommand;
use ersaazis\cb\commands\Generate;
use ersaazis\cb\commands\MigrateData;
use ersaazis\cb\controllers\scaffolding\singletons\ColumnSingleton;
use ersaazis\cb\helpers\MiscellanousSingleton;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use ersaazis\cb\commands\Install;
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
        $this->loadViewsFrom(__DIR__.'/views', 'crud');
        $this->loadViewsFrom(__DIR__.'/types', 'types');
        $this->loadTranslationsFrom(__DIR__."/localization","cb");

        // Publish the files
        $this->publishes([__DIR__.'/configs/crud.php' => config_path('crud.php')],'cb_config');
        $this->publishes([__DIR__.'/controller_extends' => base_path('app/Http/Controllers/Crud')],'cb_controller');
        $this->publishes([__DIR__.'/database' => base_path('database')],'cb_migration');
        $this->publishes([__DIR__.'/templates/CBHook.stub'=> app_path('Http/CBHook.php')],'cb_hook');
        $this->publishes([__DIR__ .'/assets' =>public_path('cb_asset')],'cb_asset');
        $this->publishes([__DIR__ .'/rebuild.stub' =>base_path('rebuild.sh')],'cb_rebuild');

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
        $this->app->singleton('crud', function ()
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
        $this->mergeConfigFrom(__DIR__.'/configs/crud.php','crud');

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
