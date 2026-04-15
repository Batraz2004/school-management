<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property-read schoolClass $schoolClass
 * @property-read Subject $subject
 * @property-read User $teacher
 * @property Carbon $event_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Exam extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(schoolClass::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
