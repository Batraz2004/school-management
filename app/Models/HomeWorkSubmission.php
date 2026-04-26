<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $home_work_status
 * 
 * @property LessonInstance $lessonInstance
 * @property User $student
 * 
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class HomeWorkSubmission extends Model
{
    protected $guarded = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function homework(): BelongsTo
    {
        return $this->belongsTo(Homework::class);
    }

    public function lessonInstance(): BelongsTo
    {
        return $this->belongsTo(LessonInstance::class);
    }
}
