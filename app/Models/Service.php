<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['service_category_id', 'namespace', 'controller', 'method', 'action','displayName'];

    public function serviceCategory()
    {
        return $this->belongsTo('App\Models\ServiceCategory');
    }
    public function role()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function user()
    {
        return $this->belongsToMany('App\Models\User')->withPivot('login_id', 'isRoleService', 'roleCount');
    }

    public function auditLog(){
        return $this->hasMany('App\Models\AuditLog');
    }

    public function serviceUser()
    {
        return $this->hasMany('App\Models\ServiceUser');
    }
}
