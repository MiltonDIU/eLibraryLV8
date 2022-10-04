<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table="supervisors";
    protected $fillable = [
        'employeeId', 'name','email','mobile','designation','department_id'
    ];

    public function itemSemesterSupervisor()
    {
        return $this->hasMany('App\Models\ItemSemesterSupervisor');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

}
