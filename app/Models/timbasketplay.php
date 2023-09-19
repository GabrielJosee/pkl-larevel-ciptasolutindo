<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timbasketplay extends Model
{
    use HasFactory;

    protected $table = 'tim_basket_play';
    protected $primaryKey = 'id_team_play';
    public $timestamps = true;
    protected $fillable = [
        'id_team_play',
        'id_team',
        'id_player'
    ];
    public function CallPlayer()
    {
        return $this->belongsTo(Player::class, 'id_player');
    }
    public function CallTeam()
    {
        return $this->belongsTo(timbasket::class, 'id_team');
    }
}
