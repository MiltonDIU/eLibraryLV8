<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysConfig extends Model
{
    protected $table="sys_configs";
    protected $fillable = [
        '__POPULAR_MIN__', '__POPULAR_TOTAL__'
    ];
}
