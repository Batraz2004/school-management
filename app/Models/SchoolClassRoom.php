<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $number
 * @property Collection<LessonInstance> $lessonInstances
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class SchoolClassRoom extends Model
{
    protected $guarded = [];

    public function lessonInstances(): HasMany
    {
        return $this->hasMany(LessonInstance::class);
    }
}
