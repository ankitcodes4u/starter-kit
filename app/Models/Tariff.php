<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{
    use HasFactory, SoftDeletes;
    use \Wildside\Userstamps\Userstamps;

    protected $fillable = [
        'hsn_code',
        'description_of_goods',
        'units',
        'price',
        'type',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'units' => 'array',
        'price' => 'double',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
