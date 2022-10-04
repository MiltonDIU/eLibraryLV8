<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table="departments";
    protected $fillable = [
        'departmentName', 'deptShortName'
    ];

    public function item()
    {
        return $this->belongsToMany('App\Models\Item');
    }
    public function supervisor()
    {
        return $this->hasMany('App\Models\Supervisor');
    }
}
