<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'worker_name',
        'description',
        'hours',
        'rate_per_hour',
        'total_amount',
    ];

    protected $casts = [
        'date' => 'date',
        'hours' => 'decimal:2',
        'rate_per_hour' => 'decimal:2',
        'total_amount' => 'decimal:2',
    ];
}

