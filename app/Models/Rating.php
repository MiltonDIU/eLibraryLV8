<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table="ratings";
    protected $fillable = [
        'ratingName', 'image'
    ];

    public function issueTracking(){
      return $this->hasOne('App\Models\IssueTracking');
    }
}
