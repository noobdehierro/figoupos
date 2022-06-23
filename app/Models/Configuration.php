<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Configuration extends Model
{
    use HasFactory;
    use Sortable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['label', 'code', 'value', 'group', 'is_protected'];

    public $sortable = ['id','label', 'code', 'value', 'group', 'is_protected'];

}
