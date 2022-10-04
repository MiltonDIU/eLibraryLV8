<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $table = 'service_categories';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['serviceCategory', 'image','serviceCategoryShort','accessibilityWithoutAuthentication','externalUrl','isVisible'];

    public function service(){
        return $this->hasMany('App\Models\Service');
    }

    public function item()
    {
        return $this->hasOne('App\Models\Item');
    }
}
