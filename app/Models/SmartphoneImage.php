<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmartphoneImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'smartphone_id',
        'filename',
    ];
}
