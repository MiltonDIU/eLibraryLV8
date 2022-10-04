<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemAuthor extends Model
{
    protected $table="item_authors";
    protected $fillable = [
        'author_id', 'item_id'
    ];

    public function author()
    {
        return $this->belongsToMany('App\Models\Author');
    }

    public function item()
    {
        return $this->belongsToMany('App\Models\Item');
    }
}
