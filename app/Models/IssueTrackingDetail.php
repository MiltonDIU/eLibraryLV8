<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueTrackingDetail extends Model
{

    protected $fillable = [
        'issue_tracking_id', 'user_id', 'actionComments'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }

    public  function issueTracking(){
        return $this->belongsToMany('App\Models\IssueTracking');
    }
}
