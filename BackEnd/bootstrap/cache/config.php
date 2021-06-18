<?php return array (
  'activitylog' => 
  array (
    'enabled' => true,
    'delete_records_older_than_days' => 3650,
    'default_log_name' => 'default',
    'default_auth_driver' => NULL,
    'subject_returns_soft_deleted_models' => false,
    'activity_model' => 'Spatie\\Activitylog\\Models\\Activity',
    'table_name' => 'cms_activity_log',
    'database_connection' => NULL,
  ),
  'app' => 
  array (
    'name' => 'Laravel',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://nhatkyktts.xyz/',
    'asset_url' => NULL,
    'timezone' => 'Asia/Ho_Chi_Minh',
    'locale' => 'vi',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:JC/1Rf4tdUE6J+PEC6s/jD3kFMH7A8AQnFdCOt+ni9E=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'TorMorten\\Eventy\\EventServiceProvider',
      23 => 'TorMorten\\Eventy\\EventBladeServiceProvider',
      24 => 'Prettus\\Repository\\Providers\\RepositoryServiceProvider',
      25 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
      26 => 'SimpleSoftwareIO\\QrCode\\QrCodeServiceProvider',
      27 => 'Core\\Providers\\SystemServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Shortcode' => 'Webwizo\\Shortcodes\\Facades\\Shortcode',
      'Widget' => 'Arrilot\\Widgets\\AbstractWidget',
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
      'Cart' => 'Darryldecode\\Cart\\Facades\\CartFacade',
      'Tracker' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Facade',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Eventy' => 'TorMorten\\Eventy\\Facades\\Events',
      'DashboardMenu' => 'Core\\Facades\\DashboardMenuFacade',
      'PageTtitle' => 'Core\\Facades\\PageTtitleFacade',
      'Setting' => 'Core\\Facades\\SettingFacade',
      'QrCode' => 'SimpleSoftwareIO\\QrCode\\Facades\\QrCode',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'apiaccount' => 
      array (
        'driver' => 'jwt',
        'provider' => 'accounts',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Modules\\User\\Models\\User',
      ),
      'accounts' => 
      array (
        'driver' => 'eloquent',
        'model' => 'Modules\\Account\\Models\\Account',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'backup' => 
  array (
    'backup' => 
    array (
      'name' => 'backups',
      'source' => 
      array (
        'files' => 
        array (
          'include' => 
          array (
            0 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd',
          ),
          'exclude' => 
          array (
            0 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/.git',
            1 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/vendor',
            2 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/node_modules',
          ),
          'follow_links' => false,
        ),
        'databases' => 
        array (
          0 => 'mysql',
        ),
      ),
      'database_dump_compressor' => NULL,
      'destination' => 
      array (
        'filename_prefix' => 'backup-',
        'disks' => 
        array (
          0 => 'local',
        ),
      ),
      'temporary_directory' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/app/backup-temp',
    ),
    'notifications' => 
    array (
      'notifications' => 
      array (
        'Spatie\\Backup\\Notifications\\Notifications\\BackupHasFailed' => 
        array (
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\UnhealthyBackupWasFound' => 
        array (
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupHasFailed' => 
        array (
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\BackupWasSuccessful' => 
        array (
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\HealthyBackupWasFound' => 
        array (
        ),
        'Spatie\\Backup\\Notifications\\Notifications\\CleanupWasSuccessful' => 
        array (
        ),
      ),
      'notifiable' => 'Spatie\\Backup\\Notifications\\Notifiable',
      'slack' => 
      array (
        'webhook_url' => '',
        'channel' => NULL,
        'username' => NULL,
        'icon' => NULL,
      ),
    ),
    'monitor_backups' => 
    array (
      0 => 
      array (
        'name' => 'Laravel',
        'disks' => 
        array (
          0 => 'local',
        ),
        'health_checks' => 
        array (
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumAgeInDays' => 1,
          'Spatie\\Backup\\Tasks\\Monitor\\HealthChecks\\MaximumStorageInMegabytes' => 5000,
        ),
      ),
    ),
    'cleanup' => 
    array (
      'strategy' => 'Spatie\\Backup\\Tasks\\Cleanup\\Strategies\\DefaultStrategy',
      'default_strategy' => 
      array (
        'keep_all_backups_for_days' => 7,
        'keep_daily_backups_for_days' => 16,
        'keep_weekly_backups_for_weeks' => 8,
        'keep_monthly_backups_for_months' => 4,
        'keep_yearly_backups_for_years' => 2,
        'delete_oldest_backups_when_using_more_megabytes_than' => 5000,
      ),
    ),
  ),
  'breadcrumbs' => 
  array (
    'view' => 'core::theme.partials.breadcrumbs',
    'files' => NULL,
    'unnamed-route-exception' => true,
    'missing-route-bound-breadcrumb-exception' => true,
    'invalid-named-breadcrumb-exception' => true,
    'manager-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsManager',
    'generator-class' => 'DaveJamesMiller\\Breadcrumbs\\BreadcrumbsGenerator',
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'cms' => 
  array (
    'site_name' => 'GDST',
    'admin_prefix' => 'admincp',
    'version' => '4.0',
    'system_modules' => 
    array (
      0 => 'web',
      1 => 'user',
    ),
    'system_roles' => 
    array (
      'superadmin' => 
      array (
        'name' => 'superadmin',
        'title' => 'Super Admin',
        'description' => 'Quản trị toàn quyền hệ thống',
      ),
      'user' => 
      array (
        'name' => 'user',
        'title' => 'Tài khoản thông thường',
        'description' => 'Tài khoản người dùng thông thường',
      ),
    ),
    'thumbnail_folder' => 'thumb',
  ),
  'cors' => 
  array (
    'supportsCredentials' => false,
    'allowedOrigins' => 
    array (
      0 => '*',
    ),
    'allowedOriginsPatterns' => 
    array (
    ),
    'allowedHeaders' => 
    array (
      0 => '*',
    ),
    'allowedMethods' => 
    array (
      0 => '*',
    ),
    'exposedHeaders' => 
    array (
    ),
    'maxAge' => 0,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'chip-yeu',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'chip-yeu',
        'username' => 'root',
        'password' => 'mysql',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
        'dump' => 
        array (
          'dump_binary_path' => '/usr/local/ampps/mysql/bin',
          'use_single_transaction' => true,
        ),
      ),
      'tracker' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'chip-yeu',
        'username' => 'root',
        'password' => 'mysql',
        'strict' => false,
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'chip-yeu',
        'username' => 'root',
        'password' => 'mysql',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'chip-yeu',
        'username' => 'root',
        'password' => 'mysql',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'laravel_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
      'starts_with' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => ':column :direction NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'file-manager' => 
  array (
    'configRepository' => 'Alexusmai\\LaravelFileManager\\Services\\ConfigService\\DefaultConfigRepository',
    'aclRepository' => 'Alexusmai\\LaravelFileManager\\Services\\ACLService\\ConfigACLRepository',
    'routePrefix' => 'file-manager',
    'diskList' => 
    array (
      0 => 'upload',
    ),
    'leftDisk' => NULL,
    'rightDisk' => NULL,
    'leftPath' => NULL,
    'rightPath' => NULL,
    'cache' => NULL,
    'windowsConfig' => 2,
    'maxUploadFileSize' => NULL,
    'allowFileTypes' => 
    array (
    ),
    'hiddenFiles' => true,
    'middleware' => 
    array (
      0 => 'web',
    ),
    'acl' => false,
    'aclHideFromFM' => true,
    'aclStrategy' => 'blacklist',
    'aclRulesCache' => NULL,
    'aclRules' => 
    array (
      '' => 
      array (
      ),
      1 => 
      array (
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/app',
      ),
      'upload' => 
      array (
        'driver' => 'local',
        'root' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/public/upload',
        'url' => '/upload',
        'visibility' => 'public',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/app/public',
        'url' => '/storage',
        'visibility' => 'private',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
      ),
    ),
  ),
  'git-commit-checker' => 
  array (
    'enabled' => true,
    'psr2' => 
    array (
      'standard' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/config/../phpcs.xml',
      'ignored' => 
      array (
        0 => '*/database/*',
        1 => '*/public/*',
        2 => '*/assets/*',
        3 => '*/vendor/*',
      ),
    ),
    'hooks' => 
    array (
      'pre-commit' => 'Botble\\GitCommitChecker\\Commands\\PreCommitHook',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 8192,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'jwt' => 
  array (
    'secret' => 'Qv1uqtSxQm4EmRxRrHFOz1ejdQGDGzohW4oDIZKWIuMigOOCQ9CtpYEQLutIThMd',
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => NULL,
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'required_claims' => 
    array (
      0 => 'iss',
      1 => 'iat',
      2 => 'nbf',
      3 => 'sub',
      4 => 'jti',
    ),
    'persistent_claims' => 
    array (
    ),
    'lock_subject' => true,
    'leeway' => 0,
    'blacklist_enabled' => true,
    'blacklist_grace_period' => 0,
    'decrypt_cookies' => false,
    'providers' => 
    array (
      'jwt' => 'Tymon\\JWTAuth\\Providers\\JWT\\Lcobucci',
      'auth' => 'Tymon\\JWTAuth\\Providers\\Auth\\Illuminate',
      'storage' => 'Tymon\\JWTAuth\\Providers\\Storage\\Illuminate',
    ),
  ),
  'larecipe' => 
  array (
    'docs' => 
    array (
      'route' => '/docs',
      'path' => '/resources/docs',
      'landing' => 'overview',
      'middleware' => 
      array (
        0 => 'web',
      ),
    ),
    'versions' => 
    array (
      'default' => '1.0',
      'published' => 
      array (
        0 => '1.0',
      ),
    ),
    'settings' => 
    array (
      'auth' => false,
      'ga_id' => '',
      'middleware' => 
      array (
        0 => 'web',
      ),
    ),
    'cache' => 
    array (
      'enabled' => false,
      'period' => 5,
    ),
    'search' => 
    array (
      'enabled' => true,
      'default' => 'internal',
      'engines' => 
      array (
        'internal' => 
        array (
          'index' => 
          array (
            0 => 'h2',
            1 => 'h3',
          ),
        ),
        'algolia' => 
        array (
          'key' => '',
          'index' => '',
        ),
      ),
    ),
    'ui' => 
    array (
      'code_theme' => 'light',
      'fav' => '',
      'fa_v4_shims' => true,
      'show_side_bar' => true,
      'colors' => 
      array (
        'primary' => '#787AF6',
        'secondary' => '#2b9cf2',
      ),
      'theme_order' => NULL,
    ),
    'seo' => 
    array (
      'author' => '',
      'description' => '',
      'keywords' => '',
      'og' => 
      array (
        'title' => '',
        'type' => 'article',
        'url' => '',
        'image' => '',
        'description' => '',
      ),
    ),
    'forum' => 
    array (
      'enabled' => false,
      'default' => 'disqus',
      'services' => 
      array (
        'disqus' => 
        array (
          'site_name' => '',
        ),
      ),
    ),
    'packages' => 
    array (
      'path' => 'larecipe-components',
    ),
    'blade-parser' => 
    array (
      'regex' => 
      array (
        'code-blocks' => 
        array (
          'match' => '/\\<pre\\>(.|\\n)*?<\\/pre\\>/',
          'replacement' => '<code-block>',
        ),
      ),
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/resources/views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'permission' => 
  array (
    'models' => 
    array (
      'permission' => 'Modules\\User\\Models\\Permission',
      'role' => 'Modules\\User\\Models\\Role',
    ),
    'table_names' => 
    array (
      'roles' => 'user_roles',
      'permissions' => 'user_permissions',
      'model_has_permissions' => 'user_model_has_permissions',
      'model_has_roles' => 'user_model_has_roles',
      'role_has_permissions' => 'user_role_has_permissions',
    ),
    'column_names' => 
    array (
      'model_morph_key' => 'model_id',
    ),
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,
    'cache' => 
    array (
      'expiration_time' => 
      DateInterval::__set_state(array(
         'y' => 0,
         'm' => 0,
         'd' => 0,
         'h' => 24,
         'i' => 0,
         's' => 0,
         'f' => 0.0,
         'weekday' => 0,
         'weekday_behavior' => 0,
         'first_last_day_of' => 0,
         'invert' => 0,
         'days' => false,
         'special_type' => 0,
         'special_amount' => 0,
         'have_weekday_relative' => 0,
         'have_special_relative' => 0,
      )),
      'key' => 'spatie.permission.cache',
      'model_key' => 'name',
      'store' => 'default',
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cms_jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'mysql',
      'table' => 'cms_failed_jobs',
    ),
  ),
  'repository' => 
  array (
    'pagination' => 
    array (
      'limit' => 15,
    ),
    'fractal' => 
    array (
      'params' => 
      array (
        'include' => 'include',
      ),
      'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
    ),
    'cache' => 
    array (
      'enabled' => false,
      'minutes' => 30,
      'repository' => 'cache',
      'clean' => 
      array (
        'enabled' => true,
        'on' => 
        array (
          'create' => true,
          'update' => true,
          'delete' => true,
        ),
      ),
      'params' => 
      array (
        'skipCache' => 'skipCache',
      ),
      'allowed' => 
      array (
        'only' => NULL,
        'except' => NULL,
      ),
    ),
    'criteria' => 
    array (
      'acceptedConditions' => 
      array (
        0 => '=',
        1 => 'like',
      ),
      'params' => 
      array (
        'search' => 'search',
        'searchFields' => 'searchFields',
        'filter' => 'filter',
        'orderBy' => 'orderBy',
        'sortedBy' => 'sortedBy',
        'with' => 'with',
        'searchJoin' => 'searchJoin',
        'withCount' => 'withCount',
      ),
    ),
    'generator' => 
    array (
      'basePath' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/app',
      'rootNamespace' => 'App\\',
      'stubsOverridePath' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/app',
      'paths' => 
      array (
        'models' => 'Entities',
        'repositories' => 'Repositories',
        'interfaces' => 'Repositories',
        'transformers' => 'Transformers',
        'presenters' => 'Presenters',
        'validators' => 'Validators',
        'controllers' => 'Http/Controllers',
        'provider' => 'RepositoryServiceProvider',
        'criteria' => 'Criteria',
      ),
    ),
  ),
  'seo-helper' => 
  array (
    'title' => 
    array (
      'default' => 'Default Title',
      'site-name' => 'Laravel',
      'separator' => '-',
      'first' => true,
      'max' => 55,
    ),
    'description' => 
    array (
      'default' => 'Default description',
      'max' => 155,
    ),
    'keywords' => 
    array (
      'default' => 
      array (
      ),
    ),
    'misc' => 
    array (
      'canonical' => true,
      'robots' => true,
      'default' => 
      array (
        'viewport' => 'width=device-width, initial-scale=1',
        'author' => '',
        'publisher' => '',
      ),
    ),
    'webmasters' => 
    array (
      'google' => '',
      'bing' => '',
      'alexa' => '',
      'pinterest' => '',
      'yandex' => '',
    ),
    'open-graph' => 
    array (
      'enabled' => true,
      'prefix' => 'og:',
      'type' => 'website',
      'title' => 'Default Open Graph title',
      'description' => 'Default Open Graph description',
      'site-name' => '',
      'properties' => 
      array (
      ),
    ),
    'twitter' => 
    array (
      'enabled' => true,
      'prefix' => 'twitter:',
      'card' => 'summary',
      'site' => 'Username',
      'title' => 'Default Twitter Card title',
      'metas' => 
      array (
      ),
    ),
    'analytics' => 
    array (
      'google' => '',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'facebook' => 
    array (
      'client_id' => '',
      'client_secret' => '',
      'redirect' => '',
    ),
    'google' => 
    array (
      'client_id' => '',
      'client_secret' => '',
      'redirect' => '',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => true,
    'encrypt' => false,
    'files' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'tracker' => 
  array (
    'enabled' => false,
    'cache_enabled' => true,
    'use_middleware' => true,
    'do_not_track_robots' => false,
    'do_not_track_environments' => 
    array (
    ),
    'do_not_track_routes' => 
    array (
      0 => 'tracker.stats.*',
    ),
    'do_not_track_paths' => 
    array (
      0 => 'api/*',
    ),
    'do_not_track_ips' => 
    array (
    ),
    'log_untrackable_sessions' => true,
    'log_enabled' => true,
    'console_log_enabled' => false,
    'log_sql_queries' => false,
    'connection' => 'tracker',
    'do_not_log_sql_queries_connections' => 
    array (
      0 => 'tracker',
    ),
    'geoip_database_path' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/config/geoip',
    'log_sql_queries_bindings' => false,
    'log_events' => false,
    'log_only_events' => 
    array (
    ),
    'id_columns_names' => 
    array (
      0 => 'id',
    ),
    'do_not_log_events' => 
    array (
      0 => 'illuminate.log',
      1 => 'eloquent.*',
      2 => 'router.*',
      3 => 'composing: *',
      4 => 'creating: *',
    ),
    'log_geoip' => true,
    'log_user_agents' => true,
    'log_users' => false,
    'log_devices' => true,
    'log_languages' => true,
    'log_referers' => true,
    'log_paths' => true,
    'log_queries' => true,
    'log_routes' => true,
    'log_exceptions' => true,
    'store_cookie_tracker' => false,
    'tracker_cookie_name' => 'please_change_this_cookie_name',
    'tracker_session_name' => 'tracker_session',
    'user_model' => 'Modules\\User\\Models\\User',
    'session_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Session',
    'log_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Log',
    'path_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Path',
    'query_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Query',
    'query_argument_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\QueryArgument',
    'agent_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Agent',
    'device_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Device',
    'cookie_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Cookie',
    'domain_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Domain',
    'referer_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Referer',
    'referer_search_term_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\RefererSearchTerm',
    'route_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Route',
    'route_path_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\RoutePath',
    'route_path_parameter_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\RoutePathParameter',
    'error_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Error',
    'geoip_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\GeoIp',
    'sql_query_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\SqlQuery',
    'sql_query_binding_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\SqlQueryBinding',
    'sql_query_binding_parameter_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\SqlQueryBindingParameter',
    'sql_query_log_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\SqlQueryLog',
    'connection_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Connection',
    'event_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Event',
    'event_log_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\EventLog',
    'system_class_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\SystemClass',
    'language_model' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Models\\Language',
    'authentication_ioc_binding' => 
    array (
      0 => 'auth',
    ),
    'authentication_guards' => 
    array (
      0 => 'admin',
    ),
    'authenticated_check_method' => 'check',
    'authenticated_user_method' => 'user',
    'authenticated_user_id_column' => 'id',
    'authenticated_user_username_column' => 'email',
    'stats_panel_enabled' => true,
    'stats_routes_before_filter' => '',
    'stats_routes_after_filter' => '',
    'stats_routes_middleware' => 'web',
    'stats_template_path' => '/templates/sb-admin-2',
    'stats_base_uri' => 'stats',
    'stats_layout' => 'pragmarx/tracker::layout',
    'stats_controllers_namespace' => 'PragmaRX\\Tracker\\Vendor\\Laravel\\Controllers',
  ),
  'translatable' => 
  array (
    'locales' => 
    array (
      0 => 'en',
      1 => 'vi',
    ),
    'locale_separator' => '-',
    'locale' => '',
    'use_fallback' => true,
    'use_property_fallback' => false,
    'fallback_locale' => 'en',
    'translation_model_namespace' => NULL,
    'translation_suffix' => 'Translation',
    'locale_key' => 'locale',
    'to_array_always_loads_translations' => true,
    'rule_factory' => 
    array (
      'format' => 1,
      'prefix' => '%',
      'suffix' => '%',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/resources/views',
    ),
    'compiled' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/framework/views',
  ),
  'widget' => 
  array (
    'groups' => 
    array (
      'MAIN_MENU' => 
      array (
        'name' => 'MAIN_MENU',
        'title' => 'Menu chính',
        'description' => 'Khu vực menu chính ở đầu của website',
      ),
      'SLIDE_HOME' => 
      array (
        'name' => 'SLIDE_HOME',
        'title' => 'Slide trang chủ',
        'description' => 'Slide khu vực trang chủ',
      ),
      'TOP_BANNER' => 
      array (
        'name' => 'TOP_BANNER',
        'title' => 'Banner 1',
        'description' => 'Khu vực hiển thị thành viên của FIP',
      ),
      'BOTTOM_BANNER' => 
      array (
        'name' => 'BOTTOM_BANNER',
        'title' => 'Banner 2',
        'description' => 'Khu vực hiển thị đối tác của FIP',
      ),
      'POST' => 
      array (
        'name' => 'POST',
        'title' => 'Bài viết nổi bật',
        'description' => 'Bài viết nổi bật khu vực trang chủ',
      ),
      'FOOTER_LINK' => 
      array (
        'name' => 'FOOTER_LINK',
        'title' => 'Liên kết các danh mục nổi bật',
        'description' => 'Danh mục nổi bật khu vực trang chủ',
      ),
      'LINK' => 
      array (
        'name' => 'LINK',
        'title' => 'Liên kết đơn vị',
        'description' => 'Danh mục liên kết đơn vị',
      ),
      'VIDEO_GALLRY' => 
      array (
        'name' => 'VIDEO_GALLRY',
        'title' => 'Thư viện video',
        'description' => 'Thư viện video trang chủ',
      ),
      'SIDEBAR_RIGHT' => 
      array (
        'name' => 'SIDEBAR_RIGHT',
        'title' => 'Sidebar bên phải',
        'description' => 'Khu vực sidebar bên phải của website',
      ),
      'POST_MORE' => 
      array (
        'name' => 'POST_MORE',
        'title' => 'Bài viết cùng chuyên mục',
        'description' => 'Chuyên mục cùng bài viết',
      ),
      'ACTIVITY' => 
      array (
        'name' => 'ACTIVITY',
        'title' => 'Hoạt động FIP',
        'description' => 'Khu vực Hoạt động FIP',
      ),
    ),
  ),
  'laravel-widgets' => 
  array (
    'use_jquery_for_ajax_calls' => false,
    'route_middleware' => 
    array (
      0 => 'web',
    ),
    'widget_stub' => 'vendor/arrilot/laravel-widgets/src/Console/stubs/widget.stub',
    'widget_plain_stub' => 'vendor/arrilot/laravel-widgets/src/Console/stubs/widget_plain.stub',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
    ),
    'temporary_files' => 
    array (
      'local_path' => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/storage/framework/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'datatables-buttons' => 
  array (
    'namespace' => 
    array (
      'base' => 'DataTables',
      'model' => '',
    ),
    'pdf_generator' => 'snappy',
    'snappy' => 
    array (
      'options' => 
      array (
        'no-outline' => true,
        'margin-left' => '0',
        'margin-right' => '0',
        'margin-top' => '10mm',
        'margin-bottom' => '10mm',
      ),
      'orientation' => 'landscape',
    ),
    'parameters' => 
    array (
      'dom' => 'Bfrtip',
      'order' => 
      array (
        0 => 
        array (
          0 => 0,
          1 => 'desc',
        ),
      ),
      'buttons' => 
      array (
        0 => 'create',
        1 => 'export',
        2 => 'print',
        3 => 'reset',
        4 => 'reload',
      ),
    ),
    'generator' => 
    array (
      'columns' => 'id,add your columns,created_at,updated_at',
      'buttons' => 'create,export,print,reset,reload',
      'dom' => 'Bfrtip',
    ),
  ),
  'datatables-html' => 
  array (
    'namespace' => 'LaravelDataTables',
    'table' => 
    array (
      'class' => 'table',
      'id' => 'dataTableBuilder',
    ),
    'callback' => 
    array (
      0 => '$',
      1 => '$.',
      2 => 'function',
    ),
    'script' => 'datatables::script',
    'editor' => 'datatables::editor',
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'imagecache' => 
  array (
    'route' => NULL,
    'paths' => 
    array (
      0 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/public/upload',
      1 => '/usr/local/ampps/www/Bai-Tap-Chip/bai-tap-chip-yeu/BackEnd/public/images',
    ),
    'templates' => 
    array (
      'small' => 'Intervention\\Image\\Templates\\Small',
      'medium' => 'Intervention\\Image\\Templates\\Medium',
      'large' => 'Intervention\\Image\\Templates\\Large',
    ),
    'lifetime' => 43200,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'datatables-fractal' => 
  array (
    'includes' => 'include',
    'serializer' => 'League\\Fractal\\Serializer\\DataArraySerializer',
  ),
  'core::permissions' => 
  array (
    0 => 
    array (
      'name' => 'dashboard',
      'title' => 'Quản lý admin',
      'description' => 'Quản lý admin',
    ),
    1 => 
    array (
      'name' => 'client',
      'title' => 'Quản lý thông tin lô hàng',
      'description' => 'Quản lý thông tin, xuất, nhập lô hàng',
    ),
  ),
  'post::permissions' => 
  array (
    0 => 
    array (
      'name' => 'post.admin.index',
      'title' => 'Quản lý bài viết',
      'description' => 'Quản lý tât cả các thao tác với module bài viết',
    ),
  ),
  'user::layouts' => 
  array (
  ),
  'user::mail' => 
  array (
    'new_user' => 
    array (
      'name' => 'new_user',
      'title' => 'Tài khoản mới',
      'description' => 'Gửi mail khi tài khoản mới được tạo',
      'variables' => 
      array (
        0 => 
        array (
          'code' => '{email}',
          'title' => 'Email',
        ),
        1 => 
        array (
          'code' => '{password}',
          'title' => 'Mật khẩu',
        ),
        2 => 
        array (
          'code' => '{fullname}',
          'title' => 'Họ tên',
        ),
        3 => 
        array (
          'code' => '{link_callback}',
          'title' => 'Liên kết chuyển hướng',
        ),
      ),
    ),
  ),
  'user::permissions' => 
  array (
    0 => 
    array (
      'name' => 'user.admin.list',
      'title' => 'Danh sách tài khoản',
      'description' => 'Cho phép xem danh sách tài khoản',
    ),
    1 => 
    array (
      'name' => 'user.admin.add',
      'title' => 'Thêm tài khoản',
      'description' => 'Cho phép thêm tài khoản',
    ),
    2 => 
    array (
      'name' => 'user.admin.edit',
      'title' => 'Sửa tài khoản',
      'description' => 'Cho phép sửa tài khoản',
    ),
    3 => 
    array (
      'name' => 'user.admin.delete',
      'title' => 'Xóa tài khoản',
      'description' => 'Cho phép xóa tài khoản',
    ),
    4 => 
    array (
      'name' => 'department.admin.list',
      'title' => 'Danh sách phòng ban',
      'description' => 'Cho phép xem danh sách phòng ban',
    ),
    5 => 
    array (
      'name' => 'department.admin.add',
      'title' => 'Thêm phòng ban',
      'description' => 'Cho phép thêm phòng ban',
    ),
    6 => 
    array (
      'name' => 'department.admin.edit',
      'title' => 'Sửa phòng ban',
      'description' => 'Cho phép sửa phòng ban',
    ),
    7 => 
    array (
      'name' => 'department.admin.delete',
      'title' => 'Xóa phòng ban',
      'description' => 'Cho phép xóa phòng ban',
    ),
  ),
  'user::widget' => 
  array (
    'web' => 
    array (
    ),
  ),
);
