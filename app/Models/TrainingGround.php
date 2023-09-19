<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingGround extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_ground_id',
        'training_ground_name',
        'training_ground_address',
        'contact_person',
        'number_phone',
        'open_hours',
        'close_hours'

    ];
    protected $table = 'training_ground';
    public $timestamps = true;

    protected $primaryKey = 'training_ground_id';
    public function CallTraining()
    {
        return$this->belongsTo(TrainingGround::class, 'training_ground_id');
    }
}
