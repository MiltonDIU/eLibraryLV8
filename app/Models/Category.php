<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = [
        'itemCategory', 'image', 'itemCategoryShort', 'shortDescription', 'accessibilityWithoutAuthentication', 'externalUrl', 'isVisible','serial'
    ];

    public function item()
    {
        return $this->hasMany('App\Models\Item');
    }
}
