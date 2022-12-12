<?php

use Coderello\SharedData\Facades\SharedData;

function module($module = null){
    return SharedData::get($module);
}

function moduleCode($name = null)
{
    return !empty($name) ? $name : SharedData::get('module_code');
}

function moduleName($name = null)
{
    return !empty($name) ? __($name) : __(SharedData::get('menu_name'));
}

function moduleRoute($action, $param = false)
{
    return $param ? route(moduleCode() . '.' . $action, $param) : route(moduleCode() . '.' . $action);
}

function modulePath($name = null)
{
    return !empty($name) ? $name : moduleCode($name);
}

function modulePathTable($name = null)
{
    if ($name) {
        return 'pages.' . $name . '.table';
    }

    return 'pages.' . moduleCode() . '.table';
}

function modulePathForm($template = null, $name = null)
{
    if ($template && $name) {
        return 'pages.' . $template . '.' . $name;
    }

    if ($name) {
        return 'pages.' . moduleCode() . '.' . $name;
    }

    if ($template) {
        return 'pages.' . $template . '.form';
    }

    return 'pages.' . moduleCode() . '.form';
}

function moduleView($template, $data){

    $view = view($template)->with($data);
    if(request()->header('hx-request') && env('APP_SPA', false)){
        $view = $view->fragment('content');
    }

    return $view;
}
