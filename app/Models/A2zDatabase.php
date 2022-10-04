<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class A2zDatabase extends Model
{
    protected $table="a2z_databases";
    protected $fillable = [
        'user_id', 'a2z_type_id', 'a2z_vendor_id', 'a2zTitle', 'a2zDescription', 'trial', 'lock', 'redirectLink', 'isVisible'
    ];

    public function user(){
       return $this->belongsTo('App\User');
    }

    public function a2zVendor(){
        return $this->belongsTo('App\Models\A2zVendor');
    }
    public function a2zSubject(){
        return $this->belongsToMany('App\Models\A2ZSubject', 'database_subject', 'a2z_subject_id', 'a2z_database_id');
    }

    public function a2zType(){
        return $this->belongsTo('App\Models\A2zType');
    }




    public function a2zHitCounter(){
        return $this->hasOne('App\Models\A2zHitCounter');
    }


}
