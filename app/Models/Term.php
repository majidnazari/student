<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'term_number',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'term_number' => 'integer',
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function results(): HasMany
    {
        // با lesson هم eager-load میشه (برای جدول گزارش)
        return $this->hasMany(TermLessonResult::class)->with('lesson');
    }
}