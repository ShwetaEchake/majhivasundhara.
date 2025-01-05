<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\StoreQuestionRequest;
use App\Http\Requests\Admin\UpdateQuestionRequest;
use App\Models\Category;
use App\Models\CompetitionType;
use App\Models\Department;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class ContestTwoQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $competitionTypes = CompetitionType::get();
        $questions = Question::with('options', 'department', 'category')->latest()->get();

        return view('admin.questions')->with(['questions'=> $questions, 'categories'=> $categories, 'departments'=> $departments, 'competitionTypes'=> $competitionTypes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['user_id'] = auth()->user()->id;
            $input['marks'] = array_sum($request->option_marks);
            $input['name'] = $input['question'];
            $input['link_type'] = $input['link_type'] ?? 0;

            $question = Question::create( Arr::only( $input, Question::getFillables() ) );

            foreach($request->option as $key => $option)
            {
                Option::create( [
                    'question_id'=> $question->id,
                    'name'=> $option,
                    'marks'=> $request->option_marks[$key],
                    'created_by'=> auth()->user()->id,
                ] );
            }
            DB::commit();

            return response()->json(['success'=> 'Question added successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'adding', 'Question');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $categories = Category::orderBy('name')->get();
        $departments = Department::orderBy('name')->get();
        $competitionTypes = CompetitionType::get();
        $question->load('options', 'department', 'category');

        if ($question)
        {
            $departmentHtml = '<span>
                <option value="">--Select Department--</option>';
                foreach($departments as $dep):
                    $is_select = $dep->id == $question->department_id ? "selected" : "";
                    $departmentHtml .= '<option value="'.$dep->id.'" '.$is_select.'>'.$dep->name.'</option>';
                endforeach;
            $departmentHtml .= '</span>';

            $categoryHtml = '<span>
                <option value="">--Select Category --</option>';
                foreach($categories as $category):
                    $is_select = $category->id == $question->category_id ? "selected" : "";
                    $categoryHtml .= '<option value="'.$category->id.'" '.$is_select.'>'.$category->name.'</option>';
                endforeach;
            $categoryHtml .= '</span>';

            $competitionTypeHtml = '<span>
                <option value="">--Select Competition Type --</option>';
                foreach($competitionTypes as $type):
                    $is_select = $type->id == $question->competition_type_id ? "selected" : "";
                    $competitionTypeHtml .= '<option value="'.$type->id.'" '.$is_select.'>'.$type->name.'</option>';
                endforeach;
            $competitionTypeHtml .= '</span>';

            $response = [
                'result' => 1,
                'question' => $question,
                'categoryHtml' => $categoryHtml,
                'departmentHtml' => $departmentHtml,
                'competitionTypeHtml' => $competitionTypeHtml,
            ];
        }
        else
        {
            $response = ['result' => 0];
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $input['marks'] = array_sum($request->option_marks);
            $input['name'] = $input['question'];
            $input['link_type'] = $input['link_type'] ?? 0;

            $question->update( Arr::only( $input, Question::getFillables() ) );
            $optionCounts = $question->loadCount('options');
            $optionCounts = $optionCounts->options_count;

            foreach($request->option as $key => $option)
            {
                if( array_key_exists($key, $request->option_id) )
                {
                    Option::where('id', $request->option_id[$key])->update([
                        'name'=> $option,
                        'marks'=> $request->option_marks[$key],
                        'updated_by'=> auth()->user()->id,
                    ]);
                }
                else
                {
                    Option::create([
                        'question_id'=> $question->id,
                        'name'=> $option,
                        'marks'=> $request->option_marks[$key],
                        'updated_by'=> auth()->user()->id,
                    ]);
                }
            }
            if( $optionCounts > count($request->option_marks) )
            {
                Option::where('question_id', $question->id)->whereNotIn('id', $request->option_id)->delete();
            }

            DB::commit();

            return response()->json(['success'=> 'Question updated successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'updating', 'Question');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        try
        {
            DB::beginTransaction();
            $question->delete();
            DB::commit();
            return response()->json(['success'=> 'Question deleted successfully!']);
        }
        catch(\Exception $e)
        {
            return $this->respondWithAjax($e, 'deleting', 'Question');
        }
    }
}
