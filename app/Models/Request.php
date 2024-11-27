<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;
    use \Wildside\Userstamps\Userstamps;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'subject',
        'images',
        'message',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'id' => 'integer',
        'images' => 'array',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
