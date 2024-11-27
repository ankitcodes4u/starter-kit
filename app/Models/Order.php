<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    use \Wildside\Userstamps\Userstamps;

    protected $fillable = [
        'order',
        'payment_method',
        'payment_status',
        'items',
        'subtotal',
        'shipping',
        'total',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'items' => 'array',
        'subtotal' => 'double',
        'shipping' => 'double',
        'total' => 'double',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
