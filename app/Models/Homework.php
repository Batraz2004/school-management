<?php

namespace App\Models;

use App\Enums\EvaluationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property-read SchoolClass $schoolClass
 * @property-read User $teacher
 * @property-read Subject $subject
 * @property EvaluationEnum $evaluation
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Homework extends Model
{
    protected $guarded = [];

    protected $casts = [
        'evaluation' => EvaluationEnum::class,
    ];

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
