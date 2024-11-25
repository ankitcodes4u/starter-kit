<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{
    use HasFactory, SoftDeletes;
    use \Wildside\Userstamps\Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'units' => 'array',
        'price' => 'double',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
