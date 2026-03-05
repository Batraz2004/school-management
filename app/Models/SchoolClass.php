<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @property int $id
 * @property string $name
 * @property Collection<Homework> $homeworks
 * @property Collection<Exam> $exams
 * @property Collection<Lesson> $lessons
 * @property Collection<Subject> $subjects
 * @property Collection<User> $users
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SchoolClass extends Model
{
    protected $guarded = [];

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function academycYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
