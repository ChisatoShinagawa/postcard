<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message_card extends Model
{
    protected $fillable = [
        'order_id',
        'image',
        'pdf',
        'message_to',
        'message_content',
        'message_from',
        'download_at',
    ];

    // public function order()
    // {
    //     return $this->hasOne( 'App\Order' );
    // }

    public function order()
    {
        return $this->belongsTo( 'App\Order' );
    }
    
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'download_at',
    ];

   
}
