<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'idpet',
        'dokter_pemeriksa',
    ];

    public $timestamps = true;

    // Relationship with Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relationship with Dokter (through RoleUser)
    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    // Relationship with DetailRekamMedis
    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    // Relationship with KodeTindakanTerapi through DetailRekamMedis
    public function kodeTindakanTerapi()
    {
        return $this->belongsToMany(KodeTindakanTerapi::class, 'detail_rekam_medis', 'idrekam_medis', 'idkode_tindakan_terapi');
    }
}
