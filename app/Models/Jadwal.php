<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $fillable = [
        'timetable_id',
        'training_ground_id',
        'name_training',
        'training_day',
        'start_time',
        'end_time',
        'description',
        'id_team'
    ];
    protected $table = 'jadwal_latihan';
    public $timestamps = true;

    protected $primaryKey = 'timetable_id';

    public function CallTim()
    {
        return $this->belongsTo(TimBasket::class, 'id_team');
    }
    public function CallTraining()
    {
        return $this->belongsTo(TrainingGround::class, 'training_ground_id');
    }
    public function absenJadwal()
    {
        return $this->hasMany(absensi::class, 'timetable_id');
    }
    public function CallJadwalLat()
    {
        return $this->hasMany(Kegiatan::class, 'timetable_id');
    }

    public function team()
    {
        return $this->belongsTo(TimBasket::class, 'id_team', 'id_team');
    }

}
