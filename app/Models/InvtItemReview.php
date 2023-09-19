<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvtItemReview extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'invt_item_review'; 
    protected $primaryKey   = 'item_review_id';
    
    protected $guarded = [
        'item_review_id',
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
