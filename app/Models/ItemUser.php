<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemUser extends Model
{
    protected $table = "item_user";
    protected $fillable = [
        'user_id', 'item_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }
}
