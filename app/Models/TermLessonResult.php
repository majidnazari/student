<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TermLessonResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'term_id',
        'lesson_id',
        'grade',
        'grade_status',
        'coach_name',
        'description',
    ];

    protected $casts = [
        'grade' => 'decimal:2',
        'grade_status' => 'integer',
    ];

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}