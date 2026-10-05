<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public const DIFFICULTIES = ['easy', 'medium', 'hard'];

    protected $fillable = [
        'name',
        'description',
        'duration',
        'fee',
        'difficulty',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'duration' => 'integer',
            'fee' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }
}
