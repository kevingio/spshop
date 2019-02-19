<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smartphone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id',
        'store_id',
        'name',
        'price',
        'description',
        'stock',
    ];

    /**
     * Relation to Brand
     *
     */
    public function brand()
    {
        return $this->belongsTo('App\Models\Brand');
    }

    /**
     * Relation to SmartphoneImage
     *
     */
    public function image()
    {
        return $this->hasMany('App\Models\SmartphoneImage');
    }

    /**
     * Relation to Brand
     *
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
}
