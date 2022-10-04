<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class A2ZSubject extends Model
{
    protected $table="a2z_subjects";
    protected $fillable = [
        'a2zSubjectName'
    ];
    public function a2zDatabase(){
        return $this->belongsToMany('App\Models\A2zDatabase', 'database_subject', 'a2z_subject_id', 'a2z_database_id');
    }
}
