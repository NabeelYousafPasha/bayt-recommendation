<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelRating extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'rateable_type',
        'rateable_id',
        'user_id',
        'value',
        'comment',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
