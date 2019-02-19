<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'logo',
    ];

    /**
     * Relation to User
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
