<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table        = 'system_user';
    protected $primaryKey   = 'user_id';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'user_group_id',
        'full_name',
        'phone_number',
        'blokir_at',
        'blokir_id',
        'user_status',
        'seller_status',
        'id_player',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userplayer()
    {
        return $this->hasMany(Player::class, 'id_player');
    }

    public function player()
    {
        return $this->hasOne(User::class, 'id_player')->where('user_group_id', 4);
    }
    public function team()
    {
        return $this->belongsTo(TimBasket::class, 'id_team');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_player');
    }
}
