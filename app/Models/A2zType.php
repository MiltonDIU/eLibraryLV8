<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class A2zType extends Model
{
    protected $table="a2z_types";
    protected $fillable = [
        'a2zTypeName'
    ];
    public function a2zDatabase(){
        return $this->hasMany('App\Models\A2zDatabase');
    }
}
