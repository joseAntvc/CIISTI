<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    // Especifica la tabla si es diferente al nombre plural del modelo
    protected $table = 'speakers';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name', 'last_name', 'curriculum',
        'email', 'phone'
    ];

    // Relación: Un speaker puede dar muchos eventos
    public function events()
    {
        return $this->hasMany(Event::class, 'id_speaker');
    }
}
