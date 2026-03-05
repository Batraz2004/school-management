<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LessonInstance extends Model
{
    protected $guarded = [];

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
}
