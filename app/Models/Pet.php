<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan'
    ];

    // Relasi ke Pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    // Relasi ke Ras Hewan
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    // Relasi ke Jenis Hewan melalui Ras Hewan
    public function jenisHewan()
    {
        return $this->hasOneThrough(
            JenisHewan::class,
            RasHewan::class,
            'idras_hewan', // Foreign key on ras_hewan table
            'idjenis_hewan', // Foreign key on jenis_hewan table
            'idras_hewan', // Local key on pet table
            'idjenis_hewan' // Local key on ras_hewan table
        );
    }

    // Relasi ke Rekam Medis melalui Temu Dokter
    public function rekamMedis()
    {
        return $this->hasManyThrough(
            RekamMedis::class,
            TemuDokter::class,
            'idpet',
            'idreservasi_dokter',
            'idpet',
            'idreservasi_dokter'
        );
    }

    // Relasi ke Temu Dokter
    public function temuDokter()
    {
        return $this->hasMany(TemuDokter::class, 'idpet', 'idpet');
    }

    /**
     * Fetch all pets with their owner and breed details.
     * @param string $search_term Optional search term to filter results.
     * @return array
     */
    public static function getAll($search_term = '')
    {
        $query = self::select([
                    'p.idpet', 'p.nama AS nama_pet', 'p.tanggal_lahir', 'p.warna_tanda', 'p.jenis_kelamin',
                    'pem.idpemilik', 'user.nama AS nama_pemilik',
                    'rh.nama_ras', 'jh.nama_jenis_hewan'
                ])
                ->from('pet as p')
                ->join('pemilik as pem', 'p.idpemilik', '=', 'pem.idpemilik')
                ->join('user', 'pem.iduser', '=', 'user.iduser')
                ->join('ras_hewan as rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
                ->join('jenis_hewan as jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan');

        if (!empty($search_term)) {
            $query->where('p.nama', 'LIKE', "%{$search_term}%")
                  ->orWhere('user.nama', 'LIKE', "%{$search_term}%");
        }

        return $query->orderBy('p.idpet', 'DESC')->get()->toArray();
    }

    /**
     * Fetch all owners to populate a dropdown.
     * @return array
     */
    public static function getAllOwnersForSelect()
    {
        return Pemilik::join('user', 'pemilik.iduser', '=', 'user.iduser')
                      ->select('pemilik.idpemilik', 'user.nama')
                      ->orderBy('user.nama', 'ASC')
                      ->get()
                      ->toArray();
    }

    /**
     * Fetch all breeds grouped by animal type for a dropdown.
     * @return array
     */
    public static function getAllBreedsForSelect()
    {
        return RasHewan::join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
                       ->select('ras_hewan.idras_hewan', 'ras_hewan.idjenis_hewan', 'ras_hewan.nama_ras', 'jenis_hewan.nama_jenis_hewan')
                       ->orderBy('jenis_hewan.nama_jenis_hewan')
                       ->orderBy('ras_hewan.nama_ras')
                       ->get()
                       ->toArray();
    }

    /**
     * Fetch a single pet by its ID.
     * @param int $idpet
     * @return Pet|null
     */
    public static function getById($idpet)
    {
        return self::find($idpet);
    }

    /**
     * Fetch detailed information for a single pet by its ID.
     * @param int $idpet
     * @return Pet|null
     */
    public static function getDetailsById($idpet)
    {
        return self::with(['pemilik.user', 'rasHewan.jenis'])->find($idpet);
    }

    /**
     * Create a new pet record.
     * @param string $nama
     * @param string $tanggal_lahir
     * @param string $warna_tanda
     * @param string $jenis_kelamin
     * @param int $idpemilik
     * @param int $idras_hewan
     * @return array
     */
    public static function createPet($nama, $tanggal_lahir, $warna_tanda, $jenis_kelamin, $idpemilik, $idras_hewan)
    {
        try {
            self::create([
                'nama' => $nama,
                'tanggal_lahir' => $tanggal_lahir,
                'warna_tanda' => $warna_tanda,
                'jenis_kelamin' => $jenis_kelamin,
                'idpemilik' => $idpemilik,
                'idras_hewan' => $idras_hewan
            ]);
            return ['status' => 'success', 'message' => 'Data pet baru berhasil ditambahkan.'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Gagal menambahkan data pet: ' . $e->getMessage()];
        }
    }

    /**
     * Update an existing pet record.
     * @param int $idpet
     * @param string $nama
     * @param string $tanggal_lahir
     * @param string $warna_tanda
     * @param string $jenis_kelamin
     * @param int $idpemilik
     * @param int $idras_hewan
     * @return array
     */
    public static function updatePet($idpet, $nama, $tanggal_lahir, $warna_tanda, $jenis_kelamin, $idpemilik, $idras_hewan)
    {
        $pet = self::find($idpet);
        if ($pet) {
            try {
                $pet->update([
                    'nama' => $nama,
                    'tanggal_lahir' => $tanggal_lahir,
                    'warna_tanda' => $warna_tanda,
                    'jenis_kelamin' => $jenis_kelamin,
                    'idpemilik' => $idpemilik,
                    'idras_hewan' => $idras_hewan
                ]);
                return ['status' => 'success', 'message' => 'Data pet berhasil diubah.'];
            } catch (\Exception $e) {
                return ['status' => 'error', 'message' => 'Gagal mengubah data pet: ' . $e->getMessage()];
            }
        }
        return ['status' => 'error', 'message' => 'Pet tidak ditemukan.'];
    }

    /**
     * Delete a pet record by its ID.
     * @param int $idpet
     * @return bool
     */
    public static function deletePet($idpet)
    {
        $pet = self::find($idpet);
        if ($pet) {
            // Check if the pet has medical records
            if ($pet->rekamMedis()->count() > 0) {
                return false; // Cannot delete if has medical records
            }
            return $pet->delete();
        }
        return false;
    }
}
