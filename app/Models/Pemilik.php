<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $incrementing = true;
    public $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'iduser',
        'no_wa',
        'alamat',
    ];

    /** 🔹 Relasi one-to-one ke User */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    /** 🔹 Relasi one-to-many ke Pet */
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik', 'idpemilik');
    }
}
