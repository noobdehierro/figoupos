<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'operacion',
        'client_name',
        'access_token',
        'endpoint',
        'request',
        'code',
        'response',

    ];
}