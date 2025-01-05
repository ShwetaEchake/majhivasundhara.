<?php

namespace App\Http\Controllers\Field;

use App\Http\Controllers\Admin\Controller;
use App\Http\Livewire\ParyavaranDutForm;
use App\Http\Requests\Field\UpdateJJFormRequest;
use App\Http\Requests\Field\UpdatePDFormRequest;
use App\Http\Requests\Field\UpdatePDutRequest;
use App\Models\ContestentPd;
use App\Models\FieldEditedFormOne;
use App\Models\FieldEditedFormTwo;
use App\Models\User;
use App\Models\UserContest;
use App\Models\UserContestTwo;
use App\Models\Ward;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WardFormController extends Controller
{

    public function index(Ward $ward)
    {
        if (auth()->user()->competition_type_id == 1) {
            $formsList = User::query()
                ->where('ward_id', $ward->id)
                ->where('is_submitted', 1)
                ->where('competition_type_id', 1)
                // ->where('category_id', auth()->user()->category_id)
                ->withWhereHas('contests')
                ->with('category')
                ->withCount('ContestentPd')
                ->latest()
                ->get();

            foreach ($formsList as $d) {
                $contests = $d->contests;
                $paryavaranSevaQuestions = $contests->whereIn('question_id', config('default_data.paryavaran_seva_question_ids'));
                $d->paryavaran_seva_marks = $paryavaranSevaQuestions->sum('marks_obtained');

                $sum = 0;
                $contests = $d->contests->groupBy('group_id');
                foreach ($contests as $contest)
                    $sum += $contest->max('marks_obtained');

                $d->contests_sum_marks_obtained = $sum;
            }

            return view('field.paryavaran-form-list')->with(['formsList' => $formsList, 'ward' => $ward]);
        }

        $formsList = User::query()
            ->where('ward_id', $ward->id)
            ->where('competition_type_id', '2')
            ->withSum('contestTwo', 'marks_obtained')
            ->whereHas('roles', fn ($q) => $q->where('id', '1'))
            ->whereHas('contestTwo')
            ->with('category')
            ->whereNot('id', Auth::user()->id)
            ->where('is_submitted', 1)
            ->latest()->get();

        return view('field.janjagruti-form-list')->with(['formsList' => $formsList, 'ward' => $ward]);
    }


    public function viewParyavaranForm(Request $request, User $user)
    {
        $user->load('contests.department', 'contests.selectedQuestion', 'contests.selectedOption', 'category');

        return view('field.paryavaran-form-show')->with(['user' => $user]);
    }


    public function editParyavaranForm(UserContest $contest)
    {
        $contest->load('user', 'selectedQuestion', 'fieldEditedForm');
        $fieldEditedForm = $contest->fieldEditedForm;
        $contest->marks_obtained = $contest->fieldEditedForm?->marks;
        $contest->description = $contest->fieldEditedForm?->description;

        $imgesHtml = '';
        if ($fieldEditedForm)
        {
            if ($fieldEditedForm->image_1)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_1) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_2)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_2) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_3)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_3) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_4)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_4) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_5)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_5) . '" class="preview-image">
                            </div>';
        }

        $response = [
            'result' => 1,
            'contest' => $contest,
            'fieldEditedForm' => $fieldEditedForm,
            'imgesHtml' => $imgesHtml,
        ];
        return $response;
    }

    public function updateParyavaranForm(UserContest $contest, UpdatePDFormRequest $request)
    {
        $input = $request->validated();

        try {
            $images = [];
            if (array_key_exists('images', $input))
            {
                foreach ($input['images'] as $key => $image)
                {
                    $images[$key + 1] = $image->store('user_files');
                }
                $input['image_1'] = array_key_exists(1, $images) ? $images[1] : '';
                $input['image_2'] = array_key_exists(2, $images) ? $images[2] : '';
                $input['image_3'] = array_key_exists(3, $images) ? $images[3] : '';
                $input['image_4'] = array_key_exists(4, $images) ? $images[4] : '';
                $input['image_5'] = array_key_exists(5, $images) ? $images[5] : '';
            }

            DB::beginTransaction();
            FieldEditedFormOne::updateOrCreate(['user_contest_id' => $input['user_contest_id']], Arr::only($input, FieldEditedFormOne::getFillables()));

            DB::commit();

            return response()->json(['success' => 'response saved successfully!']);
        } catch (\Exception $e) {
            Log::info($e);
            return $this->respondWithAjax($e, 'saving', 'Response');
        }
    }

    public function finalSubmitParyavaranForm(Request $request, User $user)
    {
        $count = $user->contests()->doesntHave('fieldEditedForm')->count();
        if($count > 0)
        {
            return response()->json(['error2' => $count.' forms are pending to edit, please edit remaining forms and then try to submit']);
        }

        $user->field_submitted_user_id = Auth::id();
        $user->save();

        return response()->json(['success' => 'Application submitted successfully']);
    }


    public function viewParyavaranDutForm(Request $request, User $user)
    {
        $user->load('ContestentPd', 'category');

        return view('field.paryavaran-dut-form-show')->with(['user' => $user]);
    }

    public function editParyavaranDutForm(ContestentPd $contestent_pd)
    {
        $contestent_pd->load('user');

        $fileHtml = '<div class="col-4 px-1">
                        <a target="_blank" href="' . asset($contestent_pd->attached_file) . '" class="preview-image btn btn-primary btn-sm px-2 py-1">View File</a>
                    </div>';

        $response = [
            'result' => 1,
            'contestent_pd' => $contestent_pd,
            'fileHtml' => $fileHtml,
        ];
        return $response;
    }


    public function updateParyavaranDutForm(ContestentPd $contestent_pd, UpdatePDutRequest $request)
    {
        try {
            $imagePath = '';
            if ($request->file)
            {
                $imagePath = $request->file->store('user_files');
            }

            DB::beginTransaction();
            $contestent_pd->update([
                'name' => $request->name,
                'age' => $request->age,
                'gender' => $request->gender,
                'activity' => $request->activity,
                'attached_file' => $imagePath ?? $contestent_pd->attached_file,
                'field_user_id' => $request->user()->id,
            ]);

            DB::commit();

            return response()->json(['success' => 'data updated successfully!']);
        } catch (\Exception $e) {
            Log::info($e);
            return $this->respondWithAjax($e, 'updating', 'dat');
        }
    }


    public function viewJanjagrutiForm(Request $request, User $user)
    {
        $user->load('contestTwo.department', 'contestTwo.selectedQuestion', 'category');

        return view('field.janjagruti-form-show')->with(['user' => $user]);
    }

    public function editJanjagrutiForm(UserContestTwo $contest)
    {
        $contest->load('user', 'selectedQuestion', 'fieldEditedForm');
        $fieldEditedForm = $contest->fieldEditedForm;
        $contest->marks_obtained = $contest->fieldEditedForm?->marks;
        $contest->description = $contest->fieldEditedForm?->description;

        $imgesHtml = '';
        if ($fieldEditedForm) {
            if ($fieldEditedForm->image_1)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_1) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_2)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_2) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_3)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_3) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_4)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_4) . '" class="preview-image">
                            </div>';
            if ($fieldEditedForm->image_5)
                $imgesHtml .= '<div class="col-4 px-1">
                                <img src="' . asset('storage/' . $fieldEditedForm->image_5) . '" class="preview-image">
                            </div>';
        }

        $response = [
            'result' => 1,
            'contest' => $contest,
            'fieldEditedForm' => $fieldEditedForm,
            'imgesHtml' => $imgesHtml,
        ];
        return $response;
    }

    public function updateJanjagrutiForm(UserContestTwo $contest, UpdateJJFormRequest $request)
    {
        $input = $request->validated();

        try {
            $images = [];
            if (array_key_exists('images', $input))
            {
                foreach ($input['images'] as $key => $image)
                {
                    $images[$key + 1] = $image->store('user_files');
                }

                $input['image_1'] = array_key_exists(1, $images) ? $images[1] : '';
                $input['image_2'] = array_key_exists(2, $images) ? $images[2] : '';
                $input['image_3'] = array_key_exists(3, $images) ? $images[3] : '';
                $input['image_4'] = array_key_exists(4, $images) ? $images[4] : '';
                $input['image_5'] = array_key_exists(5, $images) ? $images[5] : '';
            }

            DB::beginTransaction();
            FieldEditedFormTwo::updateOrCreate(['user_contest_two_id' => $input['user_contest_two_id']], Arr::only($input, FieldEditedFormTwo::getFillables()));
            $contest->update(['marks_obtained' => $input['marks']]);
            DB::commit();

            return response()->json(['success' => 'response saved successfully!']);
        } catch (\Exception $e) {
            Log::info($e);
            return $this->respondWithAjax($e, 'saving', 'Response');
        }
    }

    public function finalSubmitJanjagrutiForm(Request $request, User $user)
    {
        $count = $user->contestTwo()->doesntHave('fieldEditedForm')->count();
        if($count > 0)
        {
            return response()->json(['error2' => $count.' forms are pending to edit, please edit remaining forms and then try to submit']);
        }

        $user->field_submitted_user_id = Auth::id();
        $user->save();

        return response()->json(['success' => 'Application submitted successfully']);
    }
}
