<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UpdateUserTwoAnswerRequest;
use App\Models\FieldEditedFormTwo;
use App\Models\User;
use App\Models\UserContestTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class JanjagrutiController extends Controller
{


    public function index(Request $request)
    {
        $mode = $request->mode ?? 1;
        $page_name = $mode == 1 ? 'Society' : 'Individual';

        $data = User::where('competition_type_id', '2')
                    ->where('competition_mode', $mode)
                    ->withSum('contestTwo', 'marks_obtained')
                    ->whereHas('roles', fn($q)=> $q->where('id', '1') )
                    ->with('competitionType', 'contestTwo.department', 'category', 'fieldEditedContestTwo')
                    ->whereNot('id', Auth::user()->id)
                    ->where('is_submitted', 1)
                    ->latest()->get();

        return view('admin.contest-two-users')->with([
                            'data'=> $data,
                            'page_name'=> $page_name,
                        ]);
    }

    public function viewForm(Request $request, $user)
    {
        $user = User::where('id', $user)->with('category', 'competitionType')->first();

        $answers = UserContestTwo::with('department', 'selectedQuestion')
                            ->where('user_id', $user->id)
                            ->get();

        return view('admin.user-answers-two')->with(['user'=> $user, 'answers'=> $answers]);
    }


    public function editForm(UserContestTwo $user_contest)
    {
        $user_contest->load('selectedQuestion');

        if ($user_contest)
        {
            $doc1Html = $user_contest->picture ? '<a target="_blank" href="'.asset('storage/'.$user_contest->picture).'" > <img src="'.asset('storage/'.$user_contest->picture).'" class="img-fluid" style="max-width: 120px; max-height: 120px; border-radius: 7px" /> </a>' : '';

            $doc2Html = $user_contest->video ? '<a target="_blank" href="'.asset('storage/'.$user_contest->video).'" > View Video </a>' : '';

            $response = [
                'result' => 1,
                'user_contest' => $user_contest,
                'doc1Html' => $doc1Html,
                'doc2Html' => $doc2Html,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }


    public function updateForm(UpdateUserTwoAnswerRequest $request, UserContestTwo $user_contest)
    {
        try
        {
            $input = $request->validated();

            DB::beginTransaction();
            $input['document_1'] = $request->document_1 ? $request->document_1->store('user_files') : $user_contest->document_1;
            $input['document_2'] = $request->document_2 ? $request->document_2->store('user_files') : $user_contest->document_2;

            $user_contest->update( Arr::only( $input, UserContestTwo::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Answer successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Answer');
        }
    }

    public function janjagrutiFieldMarks(Request $request, UserContestTwo $contest)
    {
        try
        {
            DB::beginTransaction();
            FieldEditedFormTwo::where('user_contest_two_id', $contest->id)->update(['marks' => $request->marks]);
            UserContestTwo::where('id', $contest->id)->update(['marks_obtained' => $request->marks]);
            DB::commit();

            return response()->json(['success' => 'marks updated successfully!']);
        }
        catch (\Exception $e)
        {
            Log::info($e);
            return $this->respondWithAjax($e, 'updating', 'marks');
        }
    }
}
