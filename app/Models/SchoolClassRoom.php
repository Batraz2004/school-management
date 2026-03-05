<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClassRoom extends Model
{
    protected $guarded = [];

    public function lessonInstances(): HasMany
    {
        return $this->hasMany(LessonInstance::class);
    }
}
