<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $timestamps = false;

    // Especifica la tabla si no sigue la convención de nombres pluralizados
    protected $table = 'events';

    // Define los campos permitidos para asignación masiva
    protected $fillable = [
        'title', 'description', 'date', 'date_time',
        'id_location', 'id_speaker', 'comment',
        'id_type_event', 'id_status'
    ];

    // Define las relaciones si las necesitas más adelante
    public function location() {
        return $this->belongsTo(Location::class, 'id_location');
    }

    public function speaker() {
        return $this->belongsTo(Speaker::class, 'id_speaker');
    }

    public function typeEvent()
    {
        return $this->belongsTo(TypeEvent::class, 'id_type_event');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status');
    }
}
