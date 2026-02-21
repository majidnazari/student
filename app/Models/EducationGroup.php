<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EducationGroup extends Model
{
    protected $fillable = [
        'name',
    ];

    public function majors(): HasMany
    {
        return $this->hasMany(Major::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}