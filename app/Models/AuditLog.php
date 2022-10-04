<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = "audit_logs";
    protected $fillable = [
        'user_id', 'service_id'
    ];

    public function service(){
        return $this->belongsTo('App\Models\Service');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
