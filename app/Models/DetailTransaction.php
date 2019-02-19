<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id',
        'smartphone_id',
        'qty',
        'price'
    ];

    /**
     * Relation to Smartphone
     *
     */
    public function smartphone()
    {
        return $this->belongsTo('App\Models\Smartphone');
    }
}
