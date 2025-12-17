<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRekamMedis extends Model
{
    use HasFactory;

    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';

    protected $fillable = [
        'idrekam_medis',
        'idkode_tindakan_terapi',
        'detail',
    ];

    public $timestamps = false;

    // Relationship with RekamMedis
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Relationship with KodeTindakanTerapi
public function kodeTindakanTerapi()
{
    return $this->belongsTo(
        KodeTindakanTerapi::class, 
        'idkode_tindakan_terapi', // Foreign key in detail_rekam_medis table
        'idkode_tindakan_terapi'  // Primary key in kode_tindakan_terapi table
    );
}
}
