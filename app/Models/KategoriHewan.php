<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriHewan extends Model
{
     protected $table = 'kategori_hewan';
     protected $primaryKey = 'idkategori_hewan';
     protected $fillable = ['nama_kategori_hewan'];
}