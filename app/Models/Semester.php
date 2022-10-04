<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table="semesters";
    protected $fillable = [
        'name', 'code', 'semester_year'
    ];

    public function itemSemesterSupervisor()
    {
        return $this->hasMany('App\Models\ItemSemesterSupervisor');
    }
}
