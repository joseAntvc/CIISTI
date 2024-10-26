<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    use HasFactory;

    protected $table = 'type_events';

    protected $fillable = ['type_event'];

    public function events()
    {
        return $this->hasMany(Event::class, 'id_type_event');
    }

}
