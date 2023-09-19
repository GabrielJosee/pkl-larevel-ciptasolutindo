<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvtItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'invt_item'; 
    protected $primaryKey   = 'item_id';
    
    protected $guarded = [
        'item_id',
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
