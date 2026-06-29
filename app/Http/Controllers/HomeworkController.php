<?php

namespace App\Http\Controllers;

use App\Http\Requests\homework\HomeworkRequest;
use App\Models\User;
use App\Services\Homework\HomeworkService;
use App\Services\Subject\SubjectService;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function __construct(
        public HomeworkService $homeworkService,
        public SubjectService $subjectService
    ) {}

    public function paginate(HomeworkRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $perPage = $request->query('per_page', 7);

        $subjectId = $request->query('subject_id');

        $homeworksPaginate = $this->homeworkService->paginate($user, $perPage, $subjectId);
        $subjects = $this->subjectService->get($user);

        return view('pages.homeworks', [
            'homeworksPaginate' => $homeworksPaginate,
            'subjects' => $subjects,
        ]);
    }
}
