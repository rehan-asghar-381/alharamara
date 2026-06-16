<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WoodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'default_sale_price',
        'is_active',
    ];

    protected $casts = [
        'default_sale_price' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}

