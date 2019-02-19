<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'store_id',
        'total',
        'isPaid'
    ];

    /**
     * Relation to User
     *
     */
    public function detail()
    {
        return $this->hasMany('App\Models\DetailTransaction');
    }

    /**
     * Relation to User
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Relation to User
     *
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
}
