<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderation extends Model
{
    use HasFactory;

    protected $table = 'moderations';

    protected $fillable = [
        'user_id', 'event_id',
    ];

    public $timestamps = true;
}
