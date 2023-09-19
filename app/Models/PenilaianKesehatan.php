<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianKesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_assessment_id',
        'health_assessment_schedule_id',
        'health_assessment_categories_id',
        'mark_health',
        'id_player',
    ];
    protected $table = 'health_assessment';
    public $timestamps = true;

    protected $primaryKey = 'health_assessment_id';

    public function CallJadwalKe()
    {
        return $this->belongsTo(JadwalKesehatan::class, 'health_assessment_schedule_id');
    }
    public function CallKategoriKe()
    {
        return $this->belongsTo(KategoriKesehatan::class, 'health_assessment_categories_id');
    }
    public function CallPlayKe()
    {
        return $this->belongsTo(Player::class, 'id_player');
    }
}
