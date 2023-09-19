<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimBasket extends Model
{
    use HasFactory;

    protected $table = 'tim_basket';
    protected $primaryKey = 'id_team';
    public $timestamps = true;
    protected $fillable = [
        'id_team',
        'team_name',
    ];

    
    public function CallTim()
    {
        return $this->hasMany(Jadwal::class, 'id_team');
    }
    public function CallTeam()
    {
        return $this->hasMany(timbasketplay::class, 'id_team');
    }
}
