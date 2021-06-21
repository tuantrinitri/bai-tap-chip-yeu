<?php

namespace Modules\User\Providers;

use Event;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

use Modules\User\Repositories\Eloquents\PermissionRepository;
use Modules\User\Repositories\Eloquents\RoleRepository;
use Modules\User\Repositories\Eloquents\UserInfoRepository;
use Modules\User\Repositories\Eloquents\UserRepository;
use Modules\User\Repositories\Eloquents\UserSocialRepository;
use Modules\User\Repositories\Interfaces\DepartmentInterface;
use Modules\User\Repositories\Interfaces\PermissionInterface;
use Modules\User\Repositories\Interfaces\RoleInterface;
use Modules\User\Repositories\Interfaces\UserInfoInterface;
use Modules\User\Repositories\Interfaces\UserInterface;
use Modules\User\Repositories\Interfaces\UserSocialInterface;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserInfoInterface::class, UserInfoRepository::class);
        $this->app->bind(UserSocialInterface::class, UserSocialRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
    }

    public function boot()
    {
        $module = 'user';
        $namespace = 'Modules\\User\\';
        $module_path = base_path('modules' . DIRECTORY_SEPARATOR . 'user');

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
        $this->loadAdminMenu();

        /**
         * Load widgets, shortcodes,...
         */
        // widgets: app('arrilot.widget-namespaces')->registerNamespace($module, $namespace . 'Widgets');
        // shortcodes: Shortcode::register('product', ProductShortcode::class);
    }

    public function loadAdminMenu()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'mod-user',
                    'priority'    => 3,
                    'parent_id'   => null,
                    'name'        => 'user::user.user_management',
                    'icon'        => 'fa fa-users',
                    'url'         => route('user.admin.list'),
                    'permissions' => ['user.admin.list'],
                ])
                ->registerItem([
                    'id'          => 'mod-user-list',
                    'priority'    => 1,
                    'parent_id'   => 'mod-user',
                    'name'        => 'user::user.list_user',
                    'url'         => route('user.admin.list'),
                    'permissions' => ['user.admin.list'],
                ]);

            // ->registerItem([
            //     'id'          => 'mod-user-role',
            //     'priority'    => 1,
            //     'parent_id'   => 'mod-user',
            //     'name'        => 'user::role.role_management',
            //     'url'         => route('role.admin.list'),
            //     'permissions' => ['role.admin.list'],
            // ])
            // ->registerItem([
            //     'id'          => 'mod-user-permission',
            //     'priority'    => 1,
            //     'parent_id'   => 'mod-user',
            //     'name'        => 'user::permission.permission_management',
            //     'url'         => route('permission.admin.list'),
            //     'permissions' => ['permission.admin.list'],
            // ]);
        });
    }
}