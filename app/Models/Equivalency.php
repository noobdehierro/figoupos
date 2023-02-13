<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equivalency extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = [
        'qv_offering_id',
        'altan_offering_id'
    ];

    public $sortable = [
        'qv_offering_id',
        'altan_offering_id'
    ];
}
