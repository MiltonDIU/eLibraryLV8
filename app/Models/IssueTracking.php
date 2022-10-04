<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueTracking extends Model
{
    protected $table="issue_trackings";
    protected $fillable = [
        'rating_id', 'user_id', 'title', 'comments', 'isCompleted', 'assignTo', 'assignBy', 'unread2initiator', 'unread2handler', 'createdTime'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function issueTrackingDetail(){
        return $this->hasMany('App\Models\IssueTrackingDetail')->orderBy('id','desc');
    }
    public function rating(){
        return $this->belongsTo('App\Models\Rating');
    }

}
