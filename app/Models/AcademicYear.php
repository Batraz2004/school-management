<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property-read Collection<SchoolClass> $schoolClasses
 * @property Carbon $date_start
 * @property Carbon $date_end
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AcademicYear extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
    ];

    public function schoolClasses(): HasMany
    {
        return $this->hasMany(SchoolClass::class);
    }
}
