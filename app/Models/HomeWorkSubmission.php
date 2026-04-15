<?php

namespace App\Models;

use App\Enums\AttendenceStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * 
 * @property LessonInstance $lessonInstance
 * @property User $student
 * @property AttendenceStatusEnum $attendence_status
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

    public function lessonInstance(): BelongsTo
    {
        return $this->belongsTo(LessonInstance::class);
    }
}
