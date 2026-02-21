<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'college_id',
        'education_group_id',
        'major_id',
        'student_number',
        'first_name',
        'last_name',
        'photo_path',
    ];

    protected $appends = [
        'full_name',
    ];

    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class);
    }

    public function educationGroup(): BelongsTo
    {
        return $this->belongsTo(EducationGroup::class);
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function terms(): HasMany
    {
        // مرتب‌سازی پیش‌فرض ترم‌ها
        return $this->hasMany(Term::class)->orderBy('term_number');
    }
}