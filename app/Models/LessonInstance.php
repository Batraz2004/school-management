<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property Collection<Attendence>|Attendence $attendences
 * @property-read User $teacher
 * @property-read Lesson $lesson
 * @property-read SchoolClassRoom $schoolClassRoom
 * @property Carbon $date_event
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LessonInstance extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date_event' => 'date',
    ];

    public function attendences(): HasMany
    {
        return $this->hasMany(Attendence::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function schoolClassRoom(): BelongsTo
    {
        return $this->belongsTo(SchoolClassRoom::class);
    }

    public function getNameAttribute()
    {
        $eventDate = (string)Carbon::parse($this->date_event)->year;

        return $eventDate;
    }
}
