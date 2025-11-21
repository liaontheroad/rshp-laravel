<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = true; // Gunakan true jika tabel di DBeaver Anda ada created_at/updated_at
    
    protected $fillable = [
        'alamat', 'no_hp', 'bidang_dokter', 'jenis_kelamin', 'id_user'
    ];

    public function user()
    {
        // Dokter belongs to a User (Relasi One-to-One dari sisi Dokter)
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}