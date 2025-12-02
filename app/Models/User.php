<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'idrole', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
        }
    }

    /**
     * Relasi belongsTo untuk Role (Digunakan oleh UserController::index)
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }

    public function hasRole($roleName)
{
    // Adjust 'name' based on the actual column storing the role name
    return $this->role && $this->role->name === $roleName;
}

    /**
     * The roles that belong to the user. (Relasi Many-to-Many Anda yang lama)
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole')
                    ->withPivot('status');
    }

    /**
     * Get the owner associated with the user.
     */
    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // Relasi One-to-One: User has one Dokter
    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id_user', 'id');
    }

    // Relasi One-to-One: User has one Perawat
    public function perawat()
    {
        return $this->hasOne(Perawat::class, 'id_user', 'id');
    }
}