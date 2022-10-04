<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemDepartment extends Model
{
    protected $table="item_departments";
    protected $fillable = [
        'item_id', 'department_id'
    ];

    public function department()
    {
        return $this->belongsToMany('App\Models\Department');
    }

    public function item()
    {
        return $this->belongsToMany('App\Models\Item');
    }
}
