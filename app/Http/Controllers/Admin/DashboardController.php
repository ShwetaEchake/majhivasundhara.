<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContestentPd;
use App\Models\Department;
use App\Models\User;
use App\Models\UserContest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth()->user();
        $isAdmin = $authUser->hasRole([ 'Admin', 'Super Admin' ]);

        $departmentWiseData = [];
        $categoryWiseUsers = [];

        if( $isAdmin )
            $categoryWiseUsers = Category::withCount(['users' => fn ($q) => $q->whereHas('roles', fn($q)=> $q->where('id', '1') )->where('competition_type_id', 1) ])->get();
        else
            $departmentWiseData = Department::withWhereHas('contests', fn($q)=> $q->where('user_id', $authUser->id) )->get();

        $jjCounts = User::select('competition_mode')->whereHas('roles', fn($q)=> $q->where('id', '1') )->where('competition_type_id', 2)->get();
        $individualJJCount = $jjCounts->where('competition_mode', 0)->count();
        $societyJJCount = $jjCounts->where('competition_mode', 1)->count();


        //
        $competitionWiseContestentsOne = User::query()
                            ->whereHas('contests')
                            ->with('category')
                            ->where('is_submitted', 1)
                            ->get();

        $competitionWiseContestentsTwo = User::query()
                            ->whereHas('contestTwo')
                            ->with('category')
                            ->where('is_submitted', 1)
                            ->get();

        // dd($competitionWiseContestentsOne->groupBy('category_id')->sortKeys());


        return view('admin.dashboard.index')->with([
                        'departmentWiseData' => $departmentWiseData,
                        'categoryWiseUsers' => $categoryWiseUsers,
                        'isAdmin' => $isAdmin,
                        'individualJJCount' => $individualJJCount,
                        'societyJJCount' => $societyJJCount,
                        'competitionWiseContestentOne' => $competitionWiseContestentsOne->groupBy('category_id')->sortKeys()->toArray(),
                        'competitionWiseContestentTwo' => $competitionWiseContestentsTwo->groupBy('competition_mode')->toArray(),
                    ]);
    }


    public function marks()
    {
        $authUser = Auth::user();
        $contestData = UserContest::select('group_id', 'marks_obtained', 'question_id')->where('user_id', $authUser->id)->distinct('question_id')->get();
        $paryavaranSevaQuestions = $contestData->whereIn('question_id', config('default_data.paryavaran_seva_question_ids'));
        $paryavaranSevaMarks = $paryavaranSevaQuestions->sum('marks_obtained');

        $contestData = $contestData->groupBy('group_id');
        $pdMarks = ContestentPd::where('user_id', Auth::user()->id)->count();

        $sum = 0;
        foreach($contestData as $contest)
            $sum += $contest->max('marks_obtained');

        $paryavaran_marks = $pdMarks > $paryavaranSevaMarks ? $pdMarks : $paryavaranSevaMarks;

        return view('frontend.total-marks')->with(['marks'=> $sum, 'paryavaranSevaMarks'=> $paryavaranSevaMarks, 'paryavaran_marks'=> $paryavaran_marks, 'authUser'=> $authUser]);
    }

}
