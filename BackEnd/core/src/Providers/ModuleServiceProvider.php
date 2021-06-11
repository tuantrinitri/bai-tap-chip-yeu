<?php

namespace Core\Providers;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $modules = cms_actived_modules();
        if (!empty($modules) && is_array($modules)) {
            $loader = new ClassLoader;
            $providers = [];
            $namespaces = [];
            if (cache()->has('module_namespaces') && cache()->has('module_providers')) {
                $providers = cache('module_providers');
                if (!is_array($providers) || empty($providers)) {
                    $providers = [];
                }

                $namespaces = cache('module_namespaces');
                if (!is_array($namespaces) || empty($namespaces)) {
                    $namespaces = [];
                }
            }

            if (empty($namespaces) || empty($providers)) {
                foreach ($modules as $module) {
                    $module_path = base_path('modules' . DIRECTORY_SEPARATOR . $module);
                    if (File::exists($module_path . DIRECTORY_SEPARATOR . 'info.json')) {
                        $content = cms_read_file_json($module_path . DIRECTORY_SEPARATOR . 'info.json');
                        if (!empty($content)) {
                            if (Arr::has($content, 'namespace') && !class_exists($content['provider'])) {
                                $namespaces[$module] = $content['namespace'];
                            }
                            $providers[] = $content['provider'];
                        }
                    }
                    app('arrilot.widget-namespaces')->registerNamespace(ucfirst($module), '\Modules\\' . ucfirst($module) . '\Widgets');
                }
                cache()->forever('module_namespaces', $namespaces);
                cache()->forever('module_providers', $providers);
            }

            foreach ($namespaces as $key => $namespace) {
                $loader->setPsr4($namespace, base_path('modules' . DIRECTORY_SEPARATOR . $key . DIRECTORY_SEPARATOR . 'src'));
            }
            $loader->register();

            foreach ($providers as $provider) {
                if (!class_exists($provider)) {
                    continue;
                }
                $this->app->register($provider);
            }
        }
    }
}
