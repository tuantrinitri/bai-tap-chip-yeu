<?php

namespace Modules\Banner\Providers;

use Event;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Banner\Repositories\Eloquents\BannerRepository;
use Modules\Banner\Repositories\Eloquents\WidgetRepository;
use Modules\Banner\Repositories\Interfaces\BannerInterface;
use Modules\Banner\Repositories\Interfaces\WidgetInterface;

class BannerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(BannerInterface::class, BannerRepository::class);
        $this->app->bind(WidgetInterface::class, WidgetRepository::class);
    }

    public function boot()
    {
        $module = 'banner';
        $namespace = 'Modules\\Banner\\';
        $module_path = base_path('modules' . DIRECTORY_SEPARATOR . 'banner');

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
         * Load admin menu
         */
        $this->loadAdminMenu();

        /**
         * Load widgets, shortcodes,...
         */
        widget: app('arrilot.widget-namespaces')->registerNamespace($module, '\Modules\\' . ucfirst($module) . '\Widgets');
        // shortcodes: Shortcode::register('product', ProductShortcode::class);
    }

    public function loadAdminMenu()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'mod-banner',
                    'priority'    => 3,
                    'parent_id'   => null,
                    'name'        => 'banner::admin.banner_management',
                    'icon'        => 'fa fa-network-wired',
                    'url'         => route('banner.admin.index'),
                    'permissions' => [],
                ])
                ->registerItem([
                    'id'          => 'mod-banner-list',
                    'priority'    => 1,
                    'parent_id'   => 'mod-banner',
                    'name'        => 'banner::admin.list_banner',
                    'url'         => route('banner.admin.index'),
                    'permissions' => ['banner.admin.index'],
                ])
                ->registerItem([
                    'id'          => 'mod-banner-create',
                    'priority'    => 2,
                    'parent_id'   => 'mod-banner',
                    'name'        => 'banner::admin.create_banner',
                    'url'         => route('banner.admin.create'),
                    'permissions' => ['banner.admin.create'],
                ]);
        });
    }
}
