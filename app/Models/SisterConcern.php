<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SisterConcern extends Model
{
    protected $table="sister_concerns";
    protected $fillable = [
        'concernName', 'emailDomain', 'concernAuthorityEmail', 'name', 'designation'
    ];

    public function user(){
        return $this->hasOne('App\User');
    }
}
