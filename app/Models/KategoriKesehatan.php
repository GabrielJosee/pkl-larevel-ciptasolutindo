<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKesehatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'health_assessment_categories_id',
        'kode_assessment',
        'name_assessment',
        'information_assessment',
    ];
    protected $table = 'health_assessment_categories';
    public $timestamps = true;

    protected $primaryKey = 'health_assessment_categories_id';

    public function CallKategoriKe()
    {
        return $this->hasMany(PenilaianKesehatan::class, 'health_assessment_categories_id');
    }
}