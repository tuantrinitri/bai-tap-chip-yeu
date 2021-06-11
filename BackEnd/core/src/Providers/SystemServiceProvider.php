<?php

namespace Core\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Core\Commands\CreateModule;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class SystemServiceProvider extends ServiceProvider
{
    public function register()
    {
        /**
         * Load Commands
         */
        $this->commands([
            CreateModule::class,
        ]);
    }

    public function boot()
    {
        try {
            DB::connection();
            Schema::defaultStringLength(191);
            if (!Schema::hasTable('cms_configs') || !Schema::hasTable('cms_modules')) {
                Artisan::call('migrate --path=core/migrations');
                cache()->flush();
            }
        } catch (\Exception $e) {
            return abort(500, 'Could not connect to the database.  Please check your configuration.');
        }


        $this->app->register(EventServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(CoreServiceProvider::class);
        $this->app->register(ModuleServiceProvider::class);
    }
}
