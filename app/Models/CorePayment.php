<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorePayment extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'core_payment'; 
    protected $primaryKey   = 'payment_id';
    
    protected $guarded = [
        'payment_id',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
    ];

}
