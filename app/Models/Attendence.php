<?php

namespace App\Models;

use App\Enums\AttendenceStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $student_id
 * @property int $lesson_instance_id
 * @property-read LessonInstance $lessonInstance
 * @property-read User $student
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Attendence extends Model
{
    protected $guarded = [];

    protected $casts = [
        'attendence_status' => AttendenceStatusEnum::class,
    ];

    public function lessonInstance(): BelongsTo
    {
        return $this->belongsTo(LessonInstance::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
