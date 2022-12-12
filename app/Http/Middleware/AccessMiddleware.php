<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Plugins\Core;
use Plugins\Helper;
use Plugins\Query;
use Plugins\Template;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }

        $route = request()->route() ?? false;
        $url = $request->url();
        // Session::flush();
        Session::push('url_history', $url);
        Session::put('url_current', $url);
        $action = $route->getAction();
        $action_code = $action['as'] ?? 'home';
        $action_controller = false;
        $action_full_controller = false;
        $action_route = $action['name'] ?? false;

        if (isset($action['controller'])) {
            $array_controller = explode('@', $action['controller']) ?? [];
            $action_controller = Core::getControllerName($array_controller[0]);
            $action_full_controller = $array_controller[0];
        }

        $menu = (array)Query::getmenu($action_route) ?? [];
        if(request()->segment(1) != 'home'){
            $permision = Query::groups(true);
        }
        else{
            $permision = Query::groups(auth()->user()->role);
        }

        if($permision->count() == 0 && request()->segment(1) != 'home'){
           abort(402, 'Maaf anda tidak punya akses!');
        }

        $data = array_merge($menu,[
            'action_code' => $action_code,
            'module_code' => $action_controller,
            'template' => $action_controller,//legacy
            'route' => $action_route,
            'controller' => $action_full_controller
        ]);
        share($data);
        // $permision = Query::permision();

        // $checkPermision = $permision->contains(function($value) use($action_code){
        //     return $value->system_permision_code == $action_code &&
        //     $value->system_permision_role_code == auth()->user()->role;
        // });

        // if(!$checkPermision){
        //     abort(403, 'You are not autorize');
        // }

        // Gate::define('allow', function ($user) use ($action_code, $permision) {
        //     return $permision->contains('system_permision_code', $action_code);
        // });

        // if (!Gate::check('allow')) {
        //     abort(403);
        // }

        try {
            share([
                // 'access' => Template::routes(),
                'filter' => Template::filter(),
                'groups' => $permision,
                'environment' => env('APP_ENV', 'local'),
                'timer' => env('APP_TIMER_ALERT', 5000),
            ]);
        } catch (\Throwable$th) {
            //throw $th;
        }

        return $next($request);
    }
}
