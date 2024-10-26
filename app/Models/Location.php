<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // Especifica la tabla si es diferente al nombre plural del modelo
    protected $table = 'locations';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'name', 'capacity', 'area'
    ];

    // Relación: Una ubicación puede albergar muchos eventos
    public function events()
    {
        return $this->hasMany(Event::class, 'id_location');
    }
}
