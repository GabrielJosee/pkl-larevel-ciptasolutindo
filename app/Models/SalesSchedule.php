<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesSchedule extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'sales_schedule'; 
    protected $primaryKey   = 'sales_schedule_id';
    
    protected $guarded = [
        'sales_schedule_id',
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
