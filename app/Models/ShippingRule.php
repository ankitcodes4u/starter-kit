<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingRule extends Model
{
    use HasFactory, SoftDeletes;
    use \Wildside\Userstamps\Userstamps;

    protected $fillable = [
        'name',
        'hsn_code',
        'rules',
        'applied_to_all',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'rules' => 'array',
        'applied_to_all' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
