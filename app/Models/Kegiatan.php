<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'timetable_id',
        'activity_name',
        'activity_start',
        'activity_end',
        'description_act',
    ];
    protected $table = 'activity';
    public $timestamps = true;

    protected $primaryKey = 'activity_id';

    public function CallJadwalLat()
    {
        return $this->belongsTo(Jadwal::class, 'timetable_id');
    }
}
