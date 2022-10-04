<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table="publishers";
    protected $fillable = [
        'publisherName', 'publisherPhone', 'publisherEmail','publisherAddress'
    ];

    public function item()
    {
        return $this->hasOne('App\Models\Item');
    }
}
