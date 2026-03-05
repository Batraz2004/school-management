<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    public function schoolClasses(): BelongsToMany
    {
        return $this->belongsToMany(SchoolClass::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}
