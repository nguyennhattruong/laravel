<?php

use Illuminate\Contracts\View\Factory as ViewFactory;

if (!function_exists('getTable')) {
    /**
     * Get Table Name
     *
     * @param $class
     * @return mixed
     */
    function getTable($class) {
        return with(new $class)->getTable();
    }
}

if (!function_exists('hasAlias')) {
    /**
     * Check alias is already exists
     *
     * @param $class
     * @param $alias
     * @return mixed
     */
    function hasAlias($class, $alias) {
        return $class::where('alias', '=', $alias)->exists();
    }
}

if (!function_exists('getImage')) {
    function getImage($file_name, $define) {
        if (trim($file_name) != '') {
            return url(config($define)) . '/' . $file_name;
        } else {
            return url('public/images/no-image.png');
        }
    }
}

if (!function_exists('getThumbImage')) {
    function getThumbImage($file_name, $define) {
        if (trim($file_name) != '') {
            return url(config($define)) . '/' . $file_name;
        } else {
            return url('public/images/no-image.png');
        }
    }
}

if (!function_exists('getBaseImage')) {
    function getBaseImage($file_name, $define) {
        return realpath(base_path(config($define) . '/' . $file_name));
    }
}

if (!function_exists('getBaseThumbImage')) {
    function getBaseThumbImage($file_name, $define) {
        return realpath(base_path(config($define) . '/' . $file_name));
    }
}

if (!function_exists('isPermission')) {
    function isPermission($route) {
        $arr = explode(',', Auth::user()->rules);
        foreach ($arr as $key => $value) {
            $arr[$key] = url($value);
        }

        if (in_array($route, $arr)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('iview')) {
    function iView($view = null, $data = [], $mergeData = []) {
        // Template
        $iview = getView($view);

        $factory = app(ViewFactory::class);

        if (func_num_args() === 0) {
            return $factory;
        }

        return $factory->make($iview, $data, $mergeData);
    }
}

if (!function_exists('getView')) {
    function getView($view = null) {
        $theme = config('define.template');
        $pathRaw = app_path("Modules/Presentation/Views/Frontend/%s/") . str_replace('.', '/', $view) . '.blade.php';
        $pathTheme = sprintf($pathRaw, config('define.template'));

        $iview = "Frontend::default.{$view}";
        if ($result = file_exists($pathTheme)) {
            $iview = "Frontend::{$theme}.{$view}";
        }

        return $iview;
    }
}

if (!function_exists('getWidgetPosition')) {
    function getWidgetPosition() {
        $template = config('define.template');
        $fileConfig = app_path("Modules/Presentation/Views/Frontend/{$template}/config.json");

        // Read JSON file
        $json = file_get_contents($fileConfig);
        $positions = json_decode($json, true)['position_template'];
        return $positions;
    }
}
