<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\UpdateUserAnswerRequest;
use App\Models\Category;
use App\Models\ContestentPd;
use App\Models\FieldEditedFormOne;
use App\Models\Option;
use App\Models\User;
use App\Models\UserContest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index(Request $request, $category, $page_type)
    {
        $category =  Category::find($category ?? 1);
        $page_type = $request->page_type ?? 0;

        $page_name = DB::table('categories')->where('id', $category->id)->value('name');
        $page_type = [0=> 'pending', 1=> 'approved', 2=> 'rejected'][$page_type];

        $data = User::where('category_id', $category->id)
                    ->where('competition_type_id', 1)
                    ->with(['contests', 'fieldEditedContestOne'])
                    ->withCount('ContestentPd')
                    ->whereHas('roles', fn($q)=> $q->where('id', '1') )
                    ->with('competitionType', 'category')
                    ->whereNot('id', Auth::user()->id)
                    ->where('is_submitted', 1)
                    ->latest()->get();

        foreach($data as $d)
        {
            $contests = $d->contests;
            $paryavaranSevaQuestions = $contests->whereIn('question_id', config('default_data.paryavaran_seva_question_ids'));
            $d->paryavaran_seva_marks = $paryavaranSevaQuestions->sum('marks_obtained');

            $sum = 0;
            $contests = $d->contests->groupBy('group_id');
            foreach($contests as $contest)
                $sum += $contest->max('marks_obtained');

            $d->contests_sum_marks_obtained = $sum;
        }

        return view('admin.contest-one-users')->with([
                            'data'=> $data,
                            'page_name'=> $page_name,
                            'page_type'=> $page_type,
                        ]);
    }


    public function viewForm(Request $request, $user)
    {
        $user = User::where('id', $user)->with('category', 'competitionType')->first();

        $answers = UserContest::with('department', 'selectedQuestion', 'selectedOption', 'fieldEditedForm')
                            ->where('user_id', $user->id)
                            ->distinct('question_id')
                            ->get();

        return view('admin.user-answers')->with(['user'=> $user, 'answers'=> $answers]);
    }

    public function viewPd(Request $request, $user)
    {
        $user = User::where('id', $user)->first();

        $pds = ContestentPd::where('user_id', $user->id)->get();

        return view('admin.user-pds')->with(['user'=> $user, 'pds'=> $pds]);
    }


    public function editForm(UserContest $user_contest)
    {
        $user_contest->load('selectedQuestion', 'selectedOption');
        $options = Option::where('question_id', $user_contest->question_id)->get();

        if ($user_contest)
        {
            $optionHtml = '<span>
                <option value="">--Select option--</option>';
                foreach($options as $option):
                    $is_select = $option->id == $user_contest->option_id ? "selected" : "";
                    $optionHtml .= '<option value="'.$option->id.'" '.$is_select.'>'.$option->name.'</option>';
                endforeach;
            $optionHtml .= '</span>';

            $doc1Html = '
                <a target="_blank" href="'.asset('storage/'.$user_contest->document_1).'" > <img src="'.asset('storage/'.$user_contest->document_1).'" class="img-fluid" style="max-width: 120px; max-height: 120px" /> </a>
            ';

            $doc2Html = '
                <a target="_blank" href="'.asset('storage/'.$user_contest->document_2).'" > <img src="'.asset('storage/'.$user_contest->document_2).'" class="img-fluid" style="max-width: 120px; max-height: 120px" /> </a>
            ';

            $response = [
                'result' => 1,
                'user_contest' => $user_contest,
                'optionHtml' => $optionHtml,
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


    public function updateForm(UpdateUserAnswerRequest $request, UserContest $user_contest)
    {
        try
        {
            $input = $request->validated();

            DB::beginTransaction();
            $input['document_1'] = $request->document_1 ? $request->document_1->store('user_files') : $user_contest->document_1;
            $input['document_2'] = $request->document_2 ? $request->document_2->store('user_files') : $user_contest->document_2;

            $user_contest->update( Arr::only( $input, UserContest::getFillables() ) );
            DB::commit();

            return response()->json(['success'=> 'Answer successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Answer');
        }
    }

    public function paryavaranFieldMarks(Request $request, UserContest $contest)
    {
        try
        {
            DB::beginTransaction();
            FieldEditedFormOne::where('user_contest_id', $contest->id)->update(['marks' => $request->marks]);
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
