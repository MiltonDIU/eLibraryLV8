<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSemesterSupervisor extends Model
{
    protected $table="item_semester_supervisors";
    protected $fillable = [
        'item_id', 'semester_id', 'supervisor_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
    public function semester()
    {
        return $this->belongsTo('App\Models\Semester');
    }
    public function supervisor()
    {
        return $this->belongsTo('App\Models\Supervisor');
    }
}
