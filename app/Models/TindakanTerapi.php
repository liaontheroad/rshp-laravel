<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanTerapi extends Model
{
    use HasFactory;

    protected $table = 'tindakan_terapi';
    protected $primaryKey = 'idtindakan_terapi'; 
    public $timestamps = false;

    protected $fillable = ['kode_tindakan', 'nama_tindakan', 'deskripsi'];
}
