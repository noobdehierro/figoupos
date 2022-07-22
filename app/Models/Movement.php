<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Movement extends Model
{
    use HasFactory;
    use Sortable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['account_id', 'amount', 'description', 'operation'];

    public $sortable = ['id', 'amount', 'description', 'operation'];
}
