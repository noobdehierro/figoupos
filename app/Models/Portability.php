<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Portability extends Model
{
    use HasFactory;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'nip',
        'msisdn',
        'msisdn_temp',
        'iccid',
        'user_id',
        'brand_id'
    ];

    public $sortable = [
        'id',
        'fullname',
        'email',
        'msisdn',
        'created_at'
    ];
}
