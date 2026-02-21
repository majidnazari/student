<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'unit',
    ];

    protected $casts = [
        'unit' => 'integer',
    ];

    public function termResults(): HasMany
    {
        return $this->hasMany(TermLessonResult::class);
    }
}