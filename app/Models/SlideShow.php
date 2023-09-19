<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    use HasFactory;

    protected $fillable = [
        'slide_id',
        'pitcure',
        'description',
        'start_date',
        'end_date',

    ];
    protected $table = 'slide_show';
    public $timestamps = true;

    protected $primaryKey = 'slide_id';
}