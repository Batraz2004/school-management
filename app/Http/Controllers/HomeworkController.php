<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Homework\HomeworkService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    public function __construct(public HomeworkService $homeworkService) {}

    public function paginate(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $perPage = $request->query('per_page', 7);

        $subjectId = $request->query('subject_index');

        $homeworksPaginate = $this->homeworkService->paginate($user, $perPage, $subjectId);

        return view('pages.homeworks', [
            'homeworksPaginate' => $homeworksPaginate,
        ]);
    }
}
