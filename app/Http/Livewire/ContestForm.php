<?php

namespace App\Http\Livewire;

use App\Mail\FinalSubmissionMail;
use App\Models\{ContestentPd, Option, Question, UserContest};
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\{Auth, DB, Log, Mail, Validator};



class ContestForm extends Component
{
    use WithFileUploads;

    protected $listeners = ['switchTab'=> 'switchTabFun'];

    public $isEditable = 0;
    public $section = 1;
    public $selected_marks = [];
    // FORM PROPERTIES
    public $qst_option, $qst_file_1, $qst_file_2, $qst_desc;
    public $hidden_qst_file_1, $hidden_qst_file_2;
    public $pd_excel;
    public $show_pd = 1;

    public function render()
    {
        $authUser = Auth::user();
        $questions = Question::withWhereHas('options')->with('department', 'category')->where(['category_id' => $authUser->category_id, 'competition_type_id' => $authUser->competition_type_id])->get();
        $questions = $questions->groupBy('department_id');

        $userAnswers = UserContest::where('user_id', $authUser->id)->distinct('question_id')->get();

        if ($userAnswers->isNotEmpty()) {
            $this->selected_marks = $userAnswers->pluck('marks_obtained', 'question_id')->toArray();
            $this->isEditable = 1;
            foreach ($userAnswers as $answer) {
                $this->qst_option[$answer->question_id] = $answer->option_id;
                $this->hidden_qst_file_1[$answer->question_id] = $answer->document_1;
                $this->hidden_qst_file_2[$answer->question_id] = $answer->document_2;
                $this->qst_desc[$answer->question_id] = $answer->description;
            }
        }

        return view('livewire.contest-form')->with(['questions' => $questions, 'authUser'=> $authUser]);
    }

    public function boot()
    {
        if(Auth::user()->category_id == 2)
            $this->show_pd = 0;
    }

    public function submitForm($actionType)
    {
        if(!$this->qst_option)
            return redirect()->route('/');

        $questions = '';
        if($actionType == 'submit')
        {
            $authUser = Auth::user();
            $questions = Question::withWhereHas('options')->where(['category_id' => $authUser->category_id, 'competition_type_id' => $authUser->competition_type_id])->get();
            $questionIdArray = $questions->pluck('id')->toArray();
            $this->addValidate($questionIdArray);
        }
        else
        {
            $questionIdArray = array_keys($this->qst_option);
            $this->addValidate($questionIdArray);
            $questions = Question::whereIn('id', $questionIdArray)->get();
        }


        if ($this->isEditable) {
            try {
                $options = Option::whereIn('id', $this->qst_option)->get();
                $user = Auth::user();
                DB::beginTransaction();
                foreach ($questions as $question) {
                    UserContest::updateOrCreate([
                        'question_id' => $question->id,
                        'user_id' => $user->id,
                        'department_id' => $question->department_id,
                    ], [
                        'group_id' => $question->group_id,
                        'option_id' => $this->qst_option[$question->id],
                        'document_1' => array_key_exists($question->id, $this->qst_file_1 ?? []) ? $this->qst_file_1[$question->id]->store('user_files') : (array_key_exists($question->id, $this->hidden_qst_file_1) ? $this->hidden_qst_file_1[$question->id] : ''),
                        'document_2' => array_key_exists($question->id, $this->qst_file_2 ?? []) ? $this->qst_file_2[$question->id]->store('user_files') : (array_key_exists($question->id, $this->hidden_qst_file_2) ? $this->hidden_qst_file_2[$question->id] : ''),
                        'description' => $this->qst_desc[$question->id],
                        'marks_obtained' => $options->where('id', $this->qst_option[$question->id])->pluck('marks')->first(),
                    ]);
                }
                DB::commit();

                if($actionType == 'submit')
                {
                    DB::table('users')->where('id', Auth::user()->id)->update(['is_submitted'=> '1']);
                    try {
                        $data = $this->calculateMarks();
                        Mail::to(Auth::user()->nodal_person_email)->send(new FinalSubmissionMail($data));
                    } catch (\Exception $e) {
                        Log::debug($e->getMessage());
                    }
                }

                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => $actionType == 'submit' ? 'तुमचा फॉर्म यशस्वीरित्या सबमिट केला गेला आहे' : 'तुमचा मसुदा यशस्वीरित्या सेव्ह झाला.']);
                return redirect()->route('marks');
            } catch (Exception $e) {
                Log::info($e->getMessage());
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'text' => 'तुमचा फॉर्म सबमिट करताना काहीतरी चूक झाली.']);
            }
        } else {
            try {
                $options = Option::whereIn('id', $this->qst_option)->get();
                $user = Auth::user();

                DB::beginTransaction();
                foreach ($questions as $question) {
                    UserContest::create([
                        'user_id' => $user->id,
                        'department_id' => $question->department_id,
                        'question_id' => $question->id,
                        'group_id' => $question->group_id,
                        'option_id' => $this->qst_option[$question->id],
                        'document_1' => array_key_exists($question->id, $this->qst_file_1 ?? []) ? $this->qst_file_1[$question->id]->store('user_files') : '',
                        'document_2' => array_key_exists($question->id, $this->qst_file_2 ?? []) ? $this->qst_file_2[$question->id]->store('user_files') : '',
                        'description' => $this->qst_desc[$question->id],
                        'marks_obtained' => $options->where('id', $this->qst_option[$question->id])->pluck('marks')->first(),
                    ]);
                }
                DB::commit();

                if($actionType == 'submit')
                {
                    DB::table('users')->where('id', Auth::user()->id)->update(['is_submitted'=> '1']);
                    try {
                        $data = $this->calculateMarks();
                        Mail::to(Auth::user()->nodal_person_email)->send(new FinalSubmissionMail($data));
                    } catch (\Exception $e) {
                        Log::debug($e->getMessage());
                    }
                }

                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => $actionType == 'submit' ? 'तुमचा फॉर्म यशस्वीरित्या सबमिट केला गेला आहे' : 'तुमचा मसुदा यशस्वीरित्या सेव्ह झाला.']);
                return redirect()->route('marks');
            } catch (Exception $e) {
                Log::info($e);
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'text' => 'तुमचा फॉर्म सबमिट करताना काहीतरी चूक झाली.']);
            }
        }
    }

    public function switchTabFun($status)
    {
        $this->show_pd = $status;
    }


    public function stepForward()
    {
        $this->section++;
    }
    public function stepBack()
    {
        $this->section--;
    }

    public function addValidate($questionIdArray)
    {
        if ($this->isEditable) {
            $this->resetErrorBag();
            $fieldArray = [];
            $messageArray = [];
            foreach ($questionIdArray as $id) {
                $fieldArray['qst_option.' . $id] = 'required';
                $fieldArray['qst_desc.' . $id] = 'required';

                $messageArray['qst_option.' . $id . '.required'] = 'Please select any option';
                $messageArray['qst_desc.' . $id . '.required'] = 'Please enter short description';
            }
            $validator = Validator::make(
                [
                    'qst_option' => $this->qst_option,
                    'qst_desc' => $this->qst_desc,
                ],
                $fieldArray,
                $messageArray
            );
            if ($validator->fails()) {
                $questionId = explode('.', $validator->errors()->keys()[0])[1];
                $this->section = Question::where('id', $questionId)->value('department_id');
                $this->dispatchBrowserEvent('validate:scroll-to', [ 'query' => '[name="'.$validator->errors()->keys()[0].'"]'  ]);
            }
            $validator->validate();
        } else {
            $this->resetErrorBag();
            $fieldArray = [];
            $messageArray = [];
            foreach ($questionIdArray as $id) {
                $fieldArray['qst_option.' . $id] = 'required';
                $fieldArray['qst_desc.' . $id] = 'required';

                $messageArray['qst_option.' . $id . '.required'] = 'Please select any option';
                $messageArray['qst_desc.' . $id . '.required'] = 'Please enter short description';
            }
            $validator = Validator::make(
                [
                    'qst_option' => $this->qst_option,
                    'qst_desc' => $this->qst_desc,
                ],
                $fieldArray,
                $messageArray
            );
            if ($validator->fails()) {
                $questionId = explode('.', $validator->errors()->keys()[0])[1];
                $this->section = Question::where('id', $questionId)->value('department_id');
                $this->dispatchBrowserEvent('validate:scroll-to', [ 'query' => '[name="'.$validator->errors()->keys()[0].'"]'  ]);
            }
            $validator->validate();
        }
    }

    public function downloadSample()
    {
        return response()->download(public_path('storage/files/sample_pd.xlsx'));
    }

    public function changeSection($section)
    {
        $this->section = $section;
        $this->show_pd = 0;
    }

    // public function updatedPdExcel()
    // {
    //     Excel::import(new ParyavaranDutImport, $this->pd_excel->store('files'));
    //     $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => 'पर्यावरण दूत एक्सेल यशस्वीरित्या अपलोड केले.']);
    // }

    protected function calculateMarks()
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

        return ['paryavaran_marks'=> $paryavaran_marks, 'marks'=> $sum];
    }
}
