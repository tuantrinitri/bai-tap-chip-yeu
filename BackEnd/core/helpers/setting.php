<?php

use Core\Facades\SettingFacade;

if (!function_exists('setting')) {
    function setting($key = null, $default = null)
    {
        if (!empty($key)) {
            try {
                return Setting::get($key, $default);
            } catch (Exception $exception) {
                info($exception->getMessage());
                return $default;
            }
        }

        return SettingFacade::getFacadeRoot();
    }
}

// load settings to override configs system
config([
    'app.url' => setting('site_url', config('app.url')),

    'mail.driver' => 'smtp',
    'mail.host' => setting('mail.host'),
    'mail.port' => setting('mail.port'),
    'mail.encryption' => setting('mail.encryption'),
    'mail.username' => setting('mail.username'),
    'mail.password' => setting('mail.password'),
    'mail.from.address' => setting('mail.from.address'),
    'mail.from.name' => setting('mail.from.name'),

    'services.facebook' => [
        'client_id' => isset($global_config['facebook_app_id']) ? $global_config['facebook_app_id'] : '',
        'client_secret' => isset($global_config['facebook_app_secret']) ? $global_config['facebook_app_secret'] : '', // Your GitHub Client Secret
        'redirect' => url('auth/facebook/callback'),
    ],
    'services.google' => [
        'client_id' => isset($global_config['google_app_id']) ? $global_config['google_app_id'] : '',
        'client_secret' => isset($global_config['google_app_secret']) ? $global_config['google_app_secret'] : '', // Your GitHub Client Secret
        'redirect' => url('auth/google/callback'),
    ],
]);