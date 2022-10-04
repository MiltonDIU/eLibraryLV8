<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table="items";
    protected $fillable = [
        'publisher_id', 'category_id','pdfFullUrl','coverImageFullUrl', 'item_standard_number_id', 'title', 'edition', 'itemStandardNumberValue','itemStandardNumberValue2', 'issue', 'keywords', 'summary', 'imageUrl', 'pdfUrl', 'isPublished', 'publicationYear', 'placeOfPublication', 'uploadImageUrl', 'slug', 'user_id','ip_address'
    ];

    public function publisher()
    {
        return $this->belongsTo('App\Models\Publisher');
    }
    public function itemSemesterSupervisor()
    {
        return $this->hasOne('App\Models\ItemSemesterSupervisor');
    }
    public function serviceCategory()
    {
        return $this->belongsTo('App\Models\ServiceCategory');
    }

    public function author()
    {
        return $this->belongsToMany('App\Models\Author');
    }

    public function department()
    {
        return $this->belongsToMany('App\Models\Department');
    }
    public function itemStandardNumber()
    {
        return $this->belongsTo('App\Models\ItemStandardNumber');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function itemView()
    {
        return $this->hasMany('App\Models\ItemView');
    }

    public function itemUser()
    {
        return $this->hasMany('App\Models\ItemUser');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
