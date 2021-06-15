<?php

namespace Modules\Post\Providers;

use Illuminate\Support\ServiceProvider;
use File;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;
use Modules\Post\Repositories\Eloquents\CategoryRepository;
use Modules\Post\Repositories\Eloquents\PostRepository;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;

class PostServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PostInterface::class, PostRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
    }

    // chay khi load trang
    public function boot()
    {
        $module = 'post';
        $module_path = base_path('modules' . DIRECTORY_SEPARATOR . 'post');

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

        // load admin menu
        $this->loadAdminMenu();
    }

    public function loadAdminMenu()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'mod-post',
                    'priority'    => 0,
                    'parent_id'   => null,
                    'name'        => 'post::post.name',
                    'icon'        => 'fas fa-newspaper',
                    'url'         => '#',
                    'permissions' => [],
                ])
                ->registerItem([
                    'id'          => 'mod-post-categories',
                    'priority'    => 3,
                    'parent_id'   => 'mod-post',
                    'name'        => 'post::category.category_setting',
                    'icon'        => null,
                    'url'         => route('category.admin.list'),
                    'permissions' => [],
                ])
                ->registerItem([
                    'id'          => 'mod-post-list',
                    'priority'    => 2,
                    'parent_id'   => 'mod-post',
                    'name'        => 'post::post.posts',
                    'icon'        => null,
                    'url'         => route('post.admin.index'),
                    'permissions' => [],
                ])
                ->registerItem([
                    'id'          => 'mod-post-add',
                    'priority'    => 1,
                    'parent_id'   => 'mod-post',
                    'name'        => 'post::post.add_post',
                    'icon'        => null,
                    'url'         => route('post.admin.create'),
                    'permissions' => [],
                ]);
        });
    }
}
