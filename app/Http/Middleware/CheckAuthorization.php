<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use DB;
use Session;

class CheckAuthorization
{

    public function handle($request, Closure $next)
    {

        $id = Auth::id();

        $services = DB::table('service_user')->where('user_id',$id)->pluck('service_id')->toArray();

        $actionName = $request->route()->getActionName();
        $method = $request->route()->methods()[0];
        $action = substr($actionName, strpos($actionName, '@') + 1);
        $namespace = substr($actionName, 0, strrpos($actionName, '\\'));
        $controller = substr($actionName, strrpos($actionName, '\\') + 1, -(strlen($action) + 1));
        // dd($services);
        if ($request->user()->isAdmin() || $request->user()->isAuthorize($services,$namespace, $controller, $method, $action)) {
            if ($action == "index" || $action == "show") {
                $request->user()->getView($services, $action, $controller);
            }
            return $next($request);
        }
        return response(view('errors.401'), 401);
    }
}
