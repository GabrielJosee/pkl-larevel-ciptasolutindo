<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'timetable_id',
        'id_player',
        'attendance_datetime',
    ];

    protected $table = 'attendance';
    public $timestamps = true;

    protected $primaryKey = 'attendance_id';

    public function absenPlayer()
    {
        return $this->belongsTo(Player::class, 'id_player');
    }

    public function absenJadwal()
    {
        return $this->belongsTo(Jadwal::class, 'timetable_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function team()
    {
        return $this->belongsTo(Player::class, 'id_team');
    }

    public function CallJadwal()
    {
        return $this->belongsTo(Jadwal::class, 'timetable_id');
    }
    public function CallPlayer()
    {
        return $this->belongsTo(Player::class, 'id_player');
    }
}
