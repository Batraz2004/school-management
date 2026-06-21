<?

namespace App\Services\Homework;

use App\Models\SchoolClass;
use App\Models\User;

class HomeworkService
{
    public function paginate(User $user, int $perPage)
    {
        /** @var SchoolClass $schoolClass */
        $schoolClass = $user
            ->schoolClasses()
            ->first();

        $homeworksPaginate = $schoolClass
            ?->homeworks()
            ->with('subject')
            ->paginate($perPage);

        return $homeworksPaginate;
    }
}
