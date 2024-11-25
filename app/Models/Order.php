<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    use \Wildside\Userstamps\Userstamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
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
