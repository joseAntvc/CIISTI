<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Relación: Un usuario pertenece a un rol.
     */
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id');
    }

    /**
     * Verificar si el usuario tiene un rol específico.
     */
    public function hasRole($roleName): bool
    {
        return $this->rol->name === $roleName;
    }

    public function moderatedEvents()
    {
        return $this->belongsToMany(Event::class, 'moderations', 'id_user', 'id_event');
    }

}
