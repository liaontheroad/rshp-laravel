<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeTindakanTerapi extends Model
{
    use HasFactory;

    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi'; // Match your schema
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;


    // Fillable fields sesuai struktur tabel
    protected $fillable = ['kode', 'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis'];

    // Accessors for view compatibility
    public function getKodeTindakanAttribute()
    {
        return $this->kode;
    }

    public function getNamaTindakanAttribute()
    {
        return $this->deskripsi_tindakan_terapi;
    }

    public function getDeskripsiAttribute()
    {
        return $this->deskripsi_tindakan_terapi;
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori', 'idkategori');
    }

    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis', 'idkategori_klinis');
    }

}
