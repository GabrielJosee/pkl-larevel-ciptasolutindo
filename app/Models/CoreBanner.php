<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoreBanner extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'core_banner'; 
    protected $primaryKey   = 'banner_id';
    
    protected $guarded = [
        'banner_id',
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
