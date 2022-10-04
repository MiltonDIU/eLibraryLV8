<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password','download', 'sister_concern_id', 'username', 'displayName', 'securityKey', 'imagePP', 'imageIcon', 'referenceId', 'verification_code', 'verified', 'diu_id', 'status', 'deptName', 'designation', 'loginStatus', 'isAdmin', 'mobile', 'imageBase64'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        //return $this->belongsTo('App\Models\Role');
        return $this->belongsToMany('App\Models\Role');
    }

    public function auditLog(){
        return $this->hasMany('App\Models\AuditLog');
    }

    public function userService(){
        return $this->hasMany('App\Models\UserService');
    }

    public function sisterConcern(){
        return $this->belongsTo('App\Models\SisterConcern');
    }

    public function issueTracking(){
        return $this->hasMany('App\Models\IssueTracking');
    }

    public function issueTrackingDetail(){
        return $this->hasMany('App\Models\IssueTrackingDetail');
    }

    public function a2zDatabase(){
        return $this->hasOne('App\Models\A2zDatabase');
    }

    /*
        public function userRole(){
            return $this->hasOne('App\Models\UserRole');
        }
    */
    public function service()
    {
        return $this->belongsToMany('App\Models\Service')->withPivot('login_id', 'isRoleService', 'roleCount');
    }

    public function serviceUser()
    {
        return $this->hasMany('App\Models\ServiceUser');
    }

    public function verified()
    {
        $this->verified = 1;
        //$this->verification_code = null;
        $this->save();
    }

    public function verifiedActive()
    {
        $this->status = 1;
        $this->verification_code = null;
        $this->save();
    }

    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Item');
    }
    public function itemUser()
    {
        return $this->hasMany('App\Models\ItemUser');
    }
    public function quota()
    {
        return $this->hasOne('App\Models\DownloadQuota');
    }
}
