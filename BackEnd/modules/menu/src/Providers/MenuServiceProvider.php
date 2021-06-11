<?php

namespace Modules\Menu\Providers;


use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Menu\Repositories\Eloquents\ItemRepository;
use Modules\Menu\Repositories\Eloquents\MenuRepository;
use Modules\Menu\Repositories\Interfaces\ItemInterface;
use Modules\Menu\Repositories\Interfaces\MenuInterface;
use Modules\User\Providers\HookServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MenuInterface::class, MenuRepository::class);
        $this->app->bind(ItemInterface::class, ItemRepository::class);
    }

    public function boot()
    {
        $module = 'menu';
        $module_path = base_path('modules' . DIRECTORY_SEPARATOR . 'menu');


        /**
         * Load routes
         */
        if (File::isDirectory($module_path . DIRECTORY_SEPARATOR . 'routes')) {
            $routes = File::glob($module_path . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . '*.php');
            foreach ($routes as $route) {
                $this->loadRoutesFrom($route);
            }
        }

        /**
         * Load helpers
         */
        if (File::isDirectory($module_path . DIRECTORY_SEPARATOR . 'helpers')) {
            $helpers = File::glob($module_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . '*.php');
            foreach ($helpers as $helper) {
                File::requireOnce($helper);
            }
        }

        /**
         * Load configs
         */
        if (File::isDirectory($module_path . DIRECTORY_SEPARATOR . 'config')) {
            $configs = File::glob($module_path . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . '*.php');
            foreach ($configs as $config) {
                $this->mergeConfigFrom($config, $module . '::' . basename($config, '.php'));
            }
        }

        /**
         * Load translations
         */
        if (File::isDirectory($module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang')) {
            $this->loadTranslationsFrom($module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang', $module);
        }

        /**
         * Load breadcrumbs
         */
        if (File::exists($module_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'breadcrumbs.php')) {
            File::requireOnce($module_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'breadcrumbs.php');
        }

        /**
         * Load views
         */
        if (File::isDirectory($module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views')) {
            $this->loadViewsFrom($module_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views', $module);
        }

        $this->app->register(HookServiceProvider::class);

        /**
         * Load admin menu
         */


        /**
         * Load widgets, shortcodes,...
         */
        app('arrilot.widget-namespaces')->registerNamespace($module, '\Modules\\' . ucfirst($module) . '\Widgets');
        // shortcodes: Shortcode::register('product', ProductShortcode::class);
    }
}
