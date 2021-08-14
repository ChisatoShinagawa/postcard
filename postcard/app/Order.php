<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // public function message_card()
    // {
    //     return $this->belongsTo( 'App\Message_card' );
    // }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'order_at',
        'delivery_at'
    ];

    protected $fillable = [
        'id',
        'order_at',
        'delivery_at',
    ];

    //protected $primaryKey = 'id';
    
    public function message_cards()
    {
        return $this->hasMany( Message_card::class );
    }

    public function message_card()
    {
        return $this->hasOne( Message_card::class );
    }
}
