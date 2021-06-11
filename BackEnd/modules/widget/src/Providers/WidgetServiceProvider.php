<?php

namespace Modules\Widget\Providers;

use Event;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Widget\Repositories\Eloquents\WidgetRepository;
use Modules\Widget\Repositories\Interfaces\WidgetInterface;

class WidgetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(WidgetInterface::class, WidgetRepository::class);
    }

    public function boot()
    {
        $module = 'widget';
        $namespace = 'Modules\\Widget\\';
        $module_path = base_path('modules' . DIRECTORY_SEPARATOR . 'widget');

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

        // $this->app->register(HookServiceProvider::class);
        /**
         * Load widgets, shortcodes,...
         */
        // widgets: app('arrilot.widget-namespaces')->registerNamespace($module, $namespace . 'Widgets');
        // shortcodes: Shortcode::register('product', ProductShortcode::class);
    }
}
