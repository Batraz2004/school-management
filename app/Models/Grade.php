<?php

namespace App\Models;

use App\Enums\EvaluationEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property-read Subject $subject
 * @property-read User $student
 * @property EvaluationEnum $evaluation
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Grade extends Model
{
    protected $guarded = [];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
