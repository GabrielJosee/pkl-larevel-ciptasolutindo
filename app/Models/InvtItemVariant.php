<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvtItemVariant extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'invt_item_variant'; 
    protected $primaryKey   = 'item_variant_id';
    
    protected $guarded = [
        'item_variant_id',
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
