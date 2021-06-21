<?php

namespace Modules\Contact\Providers;

use Event;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\Contact\Repositories\Eloquents\ContactRepository;
use Modules\Contact\Repositories\Eloquents\TopicRepository;
use Modules\Contact\Repositories\Interfaces\ContactInterface;
use Modules\Contact\Repositories\Interfaces\TopicInterface;

class ContactServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(ContactInterface::class, ContactRepository::class);
        $this->app->bind(TopicInterface::class, TopicRepository::class);
    }

    public function boot()
    {
        $module = 'contact';
        $namespace = 'Modules\\Contact\\';
        $module_path = base_path('modules' . DIRECTORY_SEPARATOR . 'contact');

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
        // widgets: app('arrilot.widget-namespaces')->registerNamespace($module, $namespace . 'Widgets');
        // shortcodes: Shortcode::register('product', ProductShortcode::class);
    }

    public function loadAdminMenu()
    {
        Event::listen(RouteMatched::class, function () {
            dashboard_menu()
                ->registerItem([
                    'id'          => 'mod-contact',
                    'priority'    => 4,
                    'parent_id'   => null,
                    'name'        => 'contact::admin.contact_management',
                    'icon'        => 'fa fa-envelope',
                    'url'         => route('contact.admin.list'),
                    'permissions' => ['contact.admin.list'],
                ])
                ->registerItem([
                    'id'          => 'mod-contact-list',
                    'priority'    => 1,
                    'parent_id'   => 'mod-contact',
                    'name'        => 'contact::admin.list_contact',
                    'url'         => route('contact.admin.list'),
                    'permissions' => ['contact.admin.list'],
                ]);
        });
    }
}