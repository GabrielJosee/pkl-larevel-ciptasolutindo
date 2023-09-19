<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_assessment_schedule_id',
        'month_period',
        'year_period',
    ];
    protected $table = 'health_assessment_schedule';
    public $timestamps = true;

    protected $primaryKey = 'health_assessment_schedule_id';

    public function CallJadwalKe()
    {
        return $this->hasMany(PenilaianKesehatan::class, 'health_assessment_schedule_id');
    }
}