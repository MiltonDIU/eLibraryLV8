<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadQuota extends Model
{
    protected $table="download_quotas";
    protected $fillable = [
        'user_id', 'quota'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
