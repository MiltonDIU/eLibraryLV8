<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class A2zHitCounter extends Model
{
    protected $table="a2z_hit_counters";
    protected $fillable = [
        'a2z_database_id', 'currentDate', 'hitCount'
    ];

    public function a2zDatabase(){
        return $this->belongsTo('App\Models\A2zDatabase');
    }
}
