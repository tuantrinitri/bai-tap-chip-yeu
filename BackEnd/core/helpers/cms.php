<?php

use Core\Facades\DashboardMenuFacade;
use Core\Facades\PageTitleFacade;

if (!function_exists('dashboard_menu')) {
    /**
     * @author Quoc Dat IT <info@quocdatit.com>
     * @return Core\Facades\DashboardMenuFacade
     */
    function dashboard_menu()
    {
        return DashboardMenuFacade::getFacadeRoot();
    }
}

if (!function_exists('page_title')) {
    /**
     * @author Quoc Dat IT <info@quocdatit.com>
     * @return Core\Facades\PageTitleFacade
     */
    function page_title()
    {
        return PageTitleFacade::getFacadeRoot();
    }
}

if (!function_exists('cms_fix_order_model')) {
    /**
     * Sort and fill correct number to order column
     * @author Quoc Dat IT <info@quocdatit.com>
     *
     * @param string $model_interface
     * @param string $column
     * @param string $id_column
     * @return void
     */
    function cms_fix_order_model(string $model_interface, string $column = 'order', string $id_column = 'id'): void
    {
        $records = app($model_interface)->orderBy($column, 'asc')->all();
        $weight = 0;
        foreach ($records as $record) {
            ++$weight;
            app($model_interface)->where($id_column, $record[$id_column])->update([
                $column => $weight
            ]);
        }
    }
}

if (!function_exists('cms_scan_folder')) {
    /**
     * Scan to get list files and folders in a folder
     * @author Quoc Dat IT <info@quocdatit.com>
     *
     * @param string $path
     * @param array $ignore_files
     * @return array
     */
    function cms_scan_folder(string $path, array $ignore_files = []): array
    {
        try {
            if (is_dir($path)) {
                $data = array_diff(scandir($path), array_merge(['.', '..'], $ignore_files));
                natsort($data);
                return $data;
            }
            return [];
        } catch (Exception $ex) {
            return [];
        }
    }
}

if (!function_exists('cms_read_file_json')) {
    /**
     * Read a json file to array
     * @author Quoc Dat IT <info@quocdatit.com>
     *
     * @param string $file
     * @param boolean $convert_to_array
     * @return array
     */
    function cms_read_file_json(string $file, bool $convert_to_array = true): array
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($convert_to_array) {
                return json_decode($file, true);
            } else {
                return $file;
            }
        }
        if (!$convert_to_array) {
            return null;
        }
        return [];
    }
}

if (!function_exists('cms_format_bytes')) {
    /**
     * Convert byte to best type
     * @author Quoc Dat IT <info@quocdatit.com>
     *
     * @param integer $bytes
     * @return string
     */
    function cms_format_bytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }
}
