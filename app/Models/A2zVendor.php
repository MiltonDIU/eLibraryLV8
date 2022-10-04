<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class A2zVendor extends Model
{
    protected $table="a2z_vendors";
    protected $fillable = [
        'a2zVendorName'
    ];

    public function a2zDatabase(){
        return $this->hasMany('App\Models\A2zDatabase');
    }
}
