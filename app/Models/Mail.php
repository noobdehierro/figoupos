<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Mail extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'description',
        'brand_id',
        'driver',
        'host',
        'port',
        'username',
        'password',
        'encryption',
        'from_address',
        'from_name',
    ];

    public $sortable = [
        'id',
        'description',
        'brand_id',
        'port',
        'username',
        'encryption',
        'from_address',
        'from_name'
    ];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
