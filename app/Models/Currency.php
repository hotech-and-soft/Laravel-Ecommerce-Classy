<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasAdvancedFilter;

    protected $filterable = [
        'id', 'name', 'sign', 'value',
    ];

    public $orderable = [
        'id', 'name', 'sign', 'value',
    ];

    protected $fillable = [
        'name', 'sign', 'value',
    ];

    public $timestamps = false;
}
