<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $fillable = [
        'operacion',
        'order_id',
        'client_name',
        'api_key',
        'api_endpoint',
        'request',
        'code',
        'response',

    ];
}