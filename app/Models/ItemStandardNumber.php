<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStandardNumber extends Model
{
    protected $table="item_standard_numbers";
    protected $fillable = [
        'itemStandardName'
    ];
    public function item()
    {
        return $this->hasOne('App\Models\Item');
    }
}
