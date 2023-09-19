<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_player',
        'id_team',
        'player_name',
        'birth_place',
        'date_birth',
        'player_address',
        'player_image',
        'player_gender',
        'player_position'

    ];
    protected $table = 'player';
    public $timestamps = true;

    protected $primaryKey = 'id_player';

    public function CallPlayer()
    {
        return $this->hasMany(timbasketplay::class, 'id_player');
    }
    public function userplayer()
    {
        return $this->belongsTo(User::class, 'id_player');
    }
    public function absenPlayer()
    {
        return $this->hasMany(absensi::class, 'id_player');
    }
}
