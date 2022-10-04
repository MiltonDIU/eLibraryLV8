<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Add2Favourite extends Model
{
    protected $table="add2_favourites";
    protected $fillable = [
        'user_id', 'item_id'
    ];
}
