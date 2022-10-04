<?php

namespace App;

use App\Models\AuditLog;
use App\Models\Service;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;

trait Authorizable
{
    public static function bootAuthorizable()
    {
        static::loaded( function ($model) {
            $model->fillable[] = 'role_id';
        });
    }

    public static function loaded($callback, $priority = 0)
    {
        static::registerModelEvent('loaded', $callback, $priority);
    }

    public function isAuthorize($services, $namespace, $controller, $method, $action)
    {
        $array = DB::table('services')
            ->where('namespace', $namespace)
            ->where('controller', $controller)
            ->where('method', $method)
            ->where('action', $action)->pluck('id')->toArray();

        $result = array_intersect($array,$services);
        if (count($result) > 0) {
            //start log
            $auditData['user_id'] = Auth::id();
            $auditData['service_id'] = $result[0];
            AuditLog::create($auditData);
            //end log
            return true;
        }
        return false;
    }

    public function getView($services, $action, $controller)
    {
        $service = Service::where('controller', $controller)->pluck('id')->toArray();
        $result = array_intersect($service, $services);
        $data = array();
        $data2 = array();
        $data3 = array();
        foreach ($result as $item) {
            $sv = Service::find($item);
            $res = $sv->action;
            $data2['slug'] = $sv->serviceCategory['serviceCategoryShort'];
            if ($res == "show" || $res == "edit" || $res == "destroy") {
                //array_push($data,[$res]>$res);
                $data[$res] = $res;
            } elseif ($res == "create") {
                $data3['create'] = $res;
            }

        }
        Session::flash('controller', $data2);
        if (!empty($data)) {
            Session::flash('viewIndex', $data);
        }
        if (!empty($data3)) {
            Session::flash('create', $data);
        }

    }


    public function isAdmin()
    {
        return $this->role_id === 1 ? true : false;
    }


    /*
    public static function bootAuthorizable()
    {
        static::loaded( function ($model) {
            $model->fillable[] = 'role_id';
        });
    }

    public function newFromBuilder($attributes = array(), $connection = NULL)
    {
        $instance = parent::newFromBuilder($attributes);

        $instance->fireModelEvent('loaded');

        return $instance;
    }

    public static function loaded($callback, $priority = 0)
    {
        static::registerModelEvent('loaded', $callback, $priority);
    }

    public function isAuthorize($namespace, $controller, $method, $action)
    {
        if(is_null($this->role_id)) {
            return false;
        }

        $permission = $this->role->permissions
            ->where('namespace', $namespace)
            ->where('controller', $controller)
            ->where('method', $method)
            ->where('action', $action);
        if (count($permission) > 0) {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        return $this->role_id === 1 ? true : false;
    }

    public function role()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    */
}