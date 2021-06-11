<?php

namespace Core\Supports;

use Core\Repositories\Interfaces\SettingInterface;
use Illuminate\Support\Arr;

class Setting
{

    protected $data;

    /**
     * Get a specific key from the settings data.
     *
     * @param  string|array $key
     * @param  mixed $default Optional default value.
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        $this->load();

        return Arr::get($this->data, $key, $default);
    }

    /**
     * Determine if a key exists in the settings data.
     *
     * @param  string $key
     *
     * @return boolean
     */
    public function has($key)
    {
        $this->load();
        return Arr::has($this->data, $key);
    }

    /**
     * Set a specific key to a value in the settings data.
     *
     * @param string|array $key Key string or associative array of key => value
     * @param mixed $value Optional only if the first argument is an array
     * @return $this
     */
    public function set($key, $value = null)
    {
        $this->load();
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Arr::set($this->data, $k, $v);
            }
        } else {
            Arr::set($this->data, $key, $value);
        }
        return $this->save();
    }

    /**
     * Unset a key in the settings data.
     *
     * @param  string $key
     * @return $this
     */
    public function forget($key)
    {
        $this->load();
        if (is_array($key)) {
            foreach ($key as $k) {
                Arr::forget($this->data, $k);
            }
        } else {
            Arr::forget($this->data, $key);
        }
        return $this->save();
    }

    /**
     * Get all settings data.
     *
     * @return array
     */
    public function all()
    {
        $this->load();
        return $this->data;
    }

    /**
     * Make sure data is loaded.
     *
     * @param boolean $force Force a reload of data. Default false.
     */
    public function load()
    {
        $this->data = $this->read();
    }

    /**
     * Read the data from the store.
     *
     * @return array
     */
    protected function read()
    {
        $data = app()->make(SettingInterface::class)->all();

        $results = [];

        foreach ($data as $row) {
            if (is_array($row)) {
                $key = $row['key'];
                $value = $row['value'];
            } elseif (is_object($row)) {
                $key = $row->{'key'};
                $value = $row->{'value'};
            } else {
                $msg = 'Expected array or object, got ' . gettype($row);
                throw new UnexpectedValueException($msg);
            }

            Arr::set($results, $key, $value);
        }

        return $results;
    }

    protected function save()
    {
        $settingRepository = app()->make(SettingInterface::class);
        $keys = $settingRepository->pluck('key');
        $insertData = Arr::dot($this->data);
        $updateData = [];
        $deleteKeys = [];

        foreach ($keys as $key) {
            if (isset($insertData[$key])) {
                $updateData[$key] = $insertData[$key];
            } else {
                $deleteKeys[] = $key;
            }
            unset($insertData[$key]);
        }

        foreach ($updateData as $key => $value) {
            $settingRepository
                ->where('key', '=', $key)
                ->update(['value' => $value]);
        }

        if ($insertData) {
            $dbData = [];
            foreach ($insertData as $key => $value) {
                $dbData[] = [
                    'key' => $key,
                    'value' => $value
                ];
            }
            // dd($dbData);
            $settingRepository->insert($dbData);
        }

        if ($deleteKeys) {
            $settingRepository
                ->whereIn('key', $deleteKeys)
                ->delete();
        }
    }
}