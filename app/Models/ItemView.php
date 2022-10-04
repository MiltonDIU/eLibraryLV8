<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemView extends Model
{
    protected $table = "item_views";
    protected $fillable = [
        'item_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }
}
