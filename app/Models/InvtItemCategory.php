<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvtItemCategory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'invt_item_category'; 
    protected $primaryKey   = 'item_category_id';
    
    protected $guarded = [
        'item_category_id',
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
