<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Balance extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'brand_id',
        'amount',
        'balance',
        'user_id',
        'user_name',
        'description'
    ];

    public $sortable = [
        'id',
        'amount',
        'balance',
        'operation',
        'user_name',
        'description',
        'created_at',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
