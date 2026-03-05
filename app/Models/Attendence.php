<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendence extends Model
{
    protected $guarded = [];

    public function lessonInstance(): BelongsTo
    {
        return $this->belongsTo(LessonInstance::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
