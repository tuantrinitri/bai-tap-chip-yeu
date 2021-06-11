<?php

namespace Modules\Post\Providers;

use Event;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Post\Repositories\Eloquents\CategoryRepository;
use Modules\Post\Repositories\Eloquents\CategoryTranslationRepository;
use Modules\Post\Repositories\Eloquents\PostRepository;
use Modules\Post\Repositories\Eloquents\PostTranlastionRepository;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\CategoryTranslationInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;
use Modules\Post\Repositories\Interfaces\PostTranlastionInterface;

class PostServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PostInterface::class, PostRepository::class);
        $this->app->bind(PostTranlastionInterface::class, PostTranlastionRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryTranslationInterface::class, CategoryTranslationRepository::class);
    }

    public function boot()
    {
        $module = 'post';
        $namespace = 'Modules\\Post\\';
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

        // $this->app->register(HookServiceProvider::class);

        /**
         * Load admin menu
         */
        $this->loadAdminMenu();

        /**
         * Load widgets, shortcodes,...
         */
        widget:
        app('arrilot.widget-namespaces')->registerNamespace(ucfirst($module), '\Modules\\' . ucfirst($module) . '\Widgets');
        // shortcodes: Shortcode::register('product', ProductShortcode::class);
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
                    'url'         => route('category.admin.index'),
                    'permissions' => ['post.admin.index'],
                ])
                ->registerItem([
                    'id'          => 'mod-post-list',
                    'priority'    => 2,
                    'parent_id'   => 'mod-post',
                    'name'        => 'post::post.posts',
                    'icon'        => null,
                    'url'         => route('post.admin.index'),
                    'permissions' => ['post.admin.index'],
                ])
                ->registerItem([
                    'id'          => 'mod-post-add',
                    'priority'    => 1,
                    'parent_id'   => 'mod-post',
                    'name'        => 'post::post.add_post',
                    'icon'        => null,
                    'url'         => route('post.admin.create'),
                    'permissions' => ['post.admin.create'],
                ]);
        });
    }
}
