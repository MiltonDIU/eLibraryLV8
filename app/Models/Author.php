<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table="authors";
    protected $fillable = [
        'authorName', 'email', 'slug'
    ];

    public function item()
    {
        return $this->belongsToMany('App\Models\Item');
    }
}
