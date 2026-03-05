<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property Collection<LessonInstance> $lessonInstances
 * @property-read SchoolClass $schoolClass
 * @property-read Subject $subject
 * @property Carbon time_start
 * @property Carbon time_end
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Lesson extends Model
{
    protected $guarded = [];

    public function lessonInstances(): HasMany
    {
        return $this->hasMany(LessonInstance::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
