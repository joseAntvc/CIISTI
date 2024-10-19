<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Relación: Un rol tiene muchos usuarios.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'id_rol', 'id');
    }
}
