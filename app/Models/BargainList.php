<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BargainList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'smartphone_id',
        'bid',
        'status'
    ];

    /**
     * Relation to Smartphone
     *
     */
    public function smartphone()
    {
        return $this->belongsTo('App\Models\Smartphone');
    }

    /**
     * Relation to User
     *
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
