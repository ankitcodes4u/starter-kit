<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    use \Wildside\Userstamps\Userstamps;

    protected $fillable = [
        'hsn_code',
        'images',
        'videos',
        'link',
        'name',
        'price',
        'bulk_price',
        'brand_id',
        'category_id',
        'unit_id',
        'minimum_order_quantity',
        'attributes',
        'badge',
        'overview',
        'description',
        'faq',
        'refundable',
        'warranty',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'additional',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'images' => 'array',
        'videos' => 'array',
        'price' => 'double',
        'bulk_price' => 'array',
        'brand_id' => 'integer',
        'category_id' => 'integer',
        'unit_id' => 'integer',
        'attributes' => 'array',
        'badge' => 'array',
        'refundable' => 'boolean',
        'warranty' => 'boolean',
        'additional' => 'array',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
