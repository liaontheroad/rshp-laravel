<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    use HasFactory;

    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';

    protected $fillable = [
        'idpet',
        'idrole_user',
        'waktu_daftar',
        'no_urut',
        'status',
    ];

    public $timestamps = false;

    // Relationships
    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function dokter()
    {
        return $this->belongsTo(RoleUser::class, 'idrole_user', 'idrole_user');
    }

    // Scope for today's appointments
    public function scopeToday($query)
    {
        return $query->whereDate('waktu_daftar', today());
    }

    // Get today's appointments
    public static function getTodaysAppointments()
    {
        return self::with(['pet', 'pet.pemilik.user', 'dokter.user'])
            ->today()
            ->orderBy('no_urut')
            ->get()
            ->map(function ($appointment) {
                return [
                    'idreservasi_dokter' => $appointment->idreservasi_dokter,
                    'no_urut' => $appointment->no_urut,
                    'waktu_daftar' => $appointment->waktu_daftar,
                    'nama_pet' => $appointment->pet->nama,
                    'nama_pemilik' => $appointment->pet->pemilik->user->nama,
                    'nama_dokter' => $appointment->dokter->user->nama,
                ];
            });
    }

    // Register new appointment
    public static function daftar($idpet, $idrole_user)
    {
        $no_urut = self::whereDate('waktu_daftar', today())->max('no_urut') + 1;

        return self::create([
            'idpet' => $idpet,
            'idrole_user' => $idrole_user,
            'waktu_daftar' => now(),
            'no_urut' => $no_urut,
        ]);
    }

    // Update appointment
    public function updateAppointment($idpet, $idrole_user)
    {
        return $this->update([
            'idpet' => $idpet,
            'idrole_user' => $idrole_user,
        ]);
    }

    // Get by ID
    public static function getById($id)
    {
        return self::with(['pet', 'pet.pemilik.user', 'dokter.user'])->find($id);
    }
}
