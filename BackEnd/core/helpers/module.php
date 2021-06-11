<?php

use Composer\Autoload\ClassLoader;
use Core\Repositories\Interfaces\MigrationInterface;
use Illuminate\Support\Facades\Artisan;
use Core\Repositories\Interfaces\ModuleInterface;
use Illuminate\Support\Facades\Schema;

if (!function_exists('cms_installed_modules')) {
    /**
     * Get list installed modules
     *
     * @param boolean $convert_array
     */
    function cms_installed_modules(bool $convert_array = true)
    {
        $modules = app(ModuleInterface::class)->all();
        if ($convert_array) {
            $result = [];
            foreach ($modules as $module) {
                $result[] = $module['name'];
            }
            return $result;
        }
        return $modules;
    }
}

if (!function_exists('cms_actived_modules')) {
    /**
     * Get list actived modules
     *
     * @param boolean $convert_array
     */
    function cms_actived_modules(bool $convert_array = true)
    {
        $modules = app(ModuleInterface::class)->where('status', 1)->get();
        if ($convert_array) {
            $result = [];
            foreach ($modules as $module) {
                $result[] = $module['name'];
            }
            return $result;
        }
        return $modules;
    }
}

if (!function_exists('cms_install_module')) {
    /**
     * Install Module
     *
     * @param string $module_name
     * @return void
     */
    function cms_install_module(string $module_name): void
    {
        if (module_check_installed($module_name)) {
            abort(500, 'Module <strong>' . $module_name . '</strong> is installed yet.');
        }

        if (!File::isDirectory(base_path('modules' . DIRECTORY_SEPARATOR . $module_name))) {
            abort(500, 'Not found module <strong>' . $module_name . '</strong>');
        }

        if (!File::exists(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'info.json'))) {
            abort(500, 'Not found <strong>info.json</strong> file in module <strong>' . $module_name . '</strong>');
        }

        $content = cms_read_file_json(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'info.json'));
        if (!isset($content['name']) || !isset($content['title']) || !isset($content['version'])) {
            abort(500, 'Content in <strong>info.json</strong> not correct. Please check again.');
        }

        app(ModuleInterface::class)->create([
            'name' => $content['name'],
            'title' => $content['title'],
            'icon' => $content['icon'] ?? '',
            'description' => $content['description'] ?? '',
            'version' => $content['version']
        ]);

        cms_fix_order_model(ModuleInterface::class, 'order', 'name');

        if (File::isDirectory(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'migrations'))) {
            Artisan::call('migrate --path=modules/' . $module_name . '/migrations');
        }

        cache()->flush();

        Artisan::call('route:clear');
    }
}

if (!function_exists('cms_uninstall_module')) {
    /**
     * Uninstall Module
     *
     * @param string $module_name
     * @return void
     */
    function cms_uninstall_module(string $module_name): void
    {
        if (!module_check_installed($module_name)) {
            abort(500, 'Module <strong>' . $module_name . '</strong> not installed yet.');
        }

        if (!File::isDirectory(base_path('modules' . DIRECTORY_SEPARATOR . $module_name))) {
            abort(500, 'Not found module <strong>' . $module_name . '</strong>');
        }

        if (!File::exists(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'info.json'))) {
            abort(500, 'Not found <strong>info.json</strong> file in module <strong>' . $module_name . '</strong>');
        }

        $content = cms_read_file_json(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'info.json'));
        if (!isset($content['name']) || !isset($content['title']) || !isset($content['version'])) {
            abort(500, 'Content in <strong>info.json</strong> not correct. Please check again.');
        }

        if (!class_exists($content['provider'])) {
            $loader = new ClassLoader;
            $loader->setPsr4($content['namespace'], base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'src'));
            $loader->register(true);
        }

        Schema::disableForeignKeyConstraints();
        if (class_exists($content['namespace'] . 'Module')) {
            call_user_func([$content['namespace'] . 'Module', 'uninstall']);
        }
        Schema::enableForeignKeyConstraints();

        app(ModuleInterface::class)->deleteWhere([
            'name' => $module_name
        ]);
        cms_fix_order_model(ModuleInterface::class, 'order', 'name');

        if (File::isDirectory(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'migrations'))) {
            $migrations = [];
            foreach (cms_scan_folder(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'migrations')) as $file) {
                $migrations[] = pathinfo($file, PATHINFO_FILENAME);
            }
            app(MigrationInterface::class)->whereIn('migration', $migrations)->delete();
        }

        cache()->flush();

        Artisan::call('route:clear');
    }
}

if (!function_exists('cms_diff_migrations_module')) {
    /**
     * Check if module had new migrations
     *
     * @param string $module_name
     * @return boolean
     */
    function cms_diff_migrations_module(string $module_name): bool
    {
        if (!module_check_installed($module_name)) {
            return true;
        }

        if (File::isDirectory(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'migrations'))) {
            $migrations = [];
            foreach (cms_scan_folder(base_path('modules' . DIRECTORY_SEPARATOR . $module_name . DIRECTORY_SEPARATOR . 'migrations')) as $file) {
                $migrations[] = pathinfo($file, PATHINFO_FILENAME);
            }
            return !(app(MigrationInterface::class)->whereIn('migration', $migrations)->count() == count($migrations));
        }
        return false;
    }
}

if (!function_exists('module_info')) {
    /**
     * Check if is an installed module
     *
     * @param [string] $module
     * @return bool
     */
    function module_info($module)
    {
        $module_info = app(ModuleInterface::class)->where('name', $module)->first()->toArray();
        $module_info['icon'] = $module_info['icon'] ?? config($module . '::module.icon');
        return $module_info;
    }
}

if (!function_exists('module_check_installed')) {
    /**
     * Check if is an installed module
     *
     * @param [string] $module
     * @return bool
     */
    function module_check_installed($module)
    {
        return in_array($module, cms_installed_modules());
    }
}

if (!function_exists('module_check_active')) {
    /**
     * Check if is an active module
     *
     * @param [string] $module
     * @return bool
     */
    function module_check_active($module)
    {
        return in_array($module, cms_actived_modules());
    }
}