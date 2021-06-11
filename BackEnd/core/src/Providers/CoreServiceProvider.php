<?php

namespace Core\Providers;

use Core\Repositories\Eloquents\SettingRepository;
use Core\Repositories\Eloquents\MigrationRepository;
use Core\Repositories\Eloquents\ModuleRepository;
use Core\Repositories\Interfaces\SettingInterface;
use Core\Repositories\Interfaces\MigrationInterface;
use Core\Repositories\Interfaces\ModuleInterface;
use Event;
use Illuminate\Support\ServiceProvider;
use File;
use Illuminate\Routing\Events\RouteMatched;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(MigrationInterface::class, MigrationRepository::class);
        $this->app->bind(SettingInterface::class, SettingRepository::class);
        $this->app->bind(ModuleInterface::class, ModuleRepository::class);
    }

    public function boot()
    {
        $core_path = base_path('core');
        view()->share('classFullsidebar', (!isset($_COOKIE['fullsidebar']) || (isset($_COOKIE['fullsidebar']) && $_COOKIE['fullsidebar'] == 'true')) ? '' : 'sidebar-xs');

        /**
         * Load routes
         */
        if (File::isDirectory($core_path . DIRECTORY_SEPARATOR . 'routes')) {
            $routes = File::glob($core_path . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . '*.php');
            foreach ($routes as $route) {
                $this->loadRoutesFrom($route);
            }
        }

        /**
         * Load helpers
         */
        if (File::isDirectory($core_path . DIRECTORY_SEPARATOR . 'helpers')) {
            $helpers = File::glob($core_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . '*.php');
            foreach ($helpers as $helper) {
                File::requireOnce($helper);
            }
        }

        /**
         * Load configs
         */
        if (File::isDirectory($core_path . DIRECTORY_SEPARATOR . 'config')) {
            $configs = File::glob($core_path . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . '*.php');
            foreach ($configs as $config) {
                $this->mergeConfigFrom($config, 'core::' . basename($config, '.php'));
            }
        }

        /**
         * Load translations
         */
        if (File::isDirectory($core_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang')) {
            $this->loadTranslationsFrom($core_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'lang', 'core');
        }

        /**
         * Load breadcrumbs
         */
        if (File::exists($core_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'breadcrumbs.php')) {
            File::requireOnce($core_path . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'breadcrumbs.php');
        }

        /**
         * Load views
         */
        if (File::isDirectory($core_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views')) {
            $this->loadViewsFrom($core_path . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views', 'core');
        }

        /**
         * Load widgets, shortcodes,...
         */
        // widgets: app('arrilot.widget-namespaces')->registerNamespace($module, $namespace . 'Widgets');
        // shortcodes: Shortcode::register('product', ProductShortcode::class);

        $system_modules = config('cms.system_modules');
        if ($system_modules) {
            foreach ($system_modules as $s_module) {
                if (!module_check_installed($s_module)) {
                    cms_install_module($s_module);
                    return redirect(url()->current());
                }
            }
        }

        /**
         * Load admin menu
         */
        $this->loadAdminMenu();
    }

    public function loadAdminMenu()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'dashboard',
                    'priority'    => 0,
                    'parent_id'   => null,
                    'name'        => 'core::common.dashboard',
                    'icon'        => 'fa fa-home',
                    'url'         => route('dashboard'),
                    'permissions' => [],
                ]);
        });
    }
}
