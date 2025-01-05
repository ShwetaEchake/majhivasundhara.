<?php

namespace App\Http\Livewire;

use App\Models\{Option, Question, UserContest};
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\{Auth, DB, Storage, Log, Validator};

class PreviewContestForm extends Component
{
    use WithFileUploads;

    protected $listeners = ['switchTab'=> 'switchTabFun'];

    public $authUser;

    public $question_id_array = [];
    public $section = 1;
    public $selected_marks = [];
    // FORM PROPERTIES
    public $qst_option, $qst_file_1, $qst_file_2, $qst_desc;
    public $show_pd = 1;


    public function render()
    {
        $authUser = Auth::user();
        $questions = Question::withWhereHas('options')->with('department', 'category', 'userSelectedOption')
                        ->where(['category_id'=> $authUser->category_id, 'competition_type_id'=> $authUser->competition_type_id])->get();

        $this->selected_marks = $questions->pluck('userSelectedOption.marks_obtained', 'userSelectedOption.question_id')->toArray();
        $this->question_id_array = $questions->pluck('id')->toArray();
        $questions = $questions->groupBy('department_id');

        return view('livewire.preview-contest-form')->with(['questions'=> $questions]);
    }

    public function boot()
    {
        if(Auth::user()->category_id == 2)
            $this->show_pd = 0;
    }

    public function submitForm()
    {
        $this->addValidate();

        $questions = Question::whereIn('id', $this->question_id_array)->get();
        try
        {
            $options = Option::whereIn('id', $this->qst_option)->get();
            $user = Auth::user();

            DB::beginTransaction();
            foreach( $questions as $question )
            {
                UserContest::create([
                    'user_id'=> $user->id,
                    'department_id'=> $question->department_id,
                    'question_id'=> $question->id,
                    'option_id'=> $this->qst_option[$question->id],
                    'document_1'=> $this->qst_file_1[$question->id]->store('user_files'),
                    'document_2'=> $this->qst_file_2[$question->id]->store('user_files'),
                    'description'=> $this->qst_desc[$question->id],
                    'marks_obtained'=> $options->where('id', $this->qst_option[$question->id])->pluck('marks')->first(),
                ]);
            }
            DB::commit();

            return redirect()->route('/');

            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'text' => 'Your form has been submitted successfully'
            ]);
        }
        catch(Exception $e)
        {
            Log::info($e);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'text' => 'Something went wrong while submitting your form.'
            ]);
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




    public function addValidate()
    {
        $this->resetErrorBag();
        $fieldArray = [];
        $messageArray = [];
        foreach($this->question_id_array as $id)
        {
            $fieldArray['qst_option.'.$id] = 'required';
            $fieldArray['qst_file_1.'.$id] = 'required';
            $fieldArray['qst_file_2.'.$id] = 'required';
            $fieldArray['qst_desc.'.$id] = 'required';

            $messageArray['qst_option.'.$id.'.required'] = 'Please select any option';
            $messageArray['qst_file_1.'.$id.'.required'] = 'Please upload file';
            $messageArray['qst_file_2.'.$id.'.required'] = 'Please upload file';
            $messageArray['qst_desc.'.$id.'.required'] = 'Please enter short description';
        }
        $validator = Validator::make(
            [
                'qst_option'=> $this->qst_option,
                'qst_file_1'=> $this->qst_file_1,
                'qst_file_2'=> $this->qst_file_2,
                'qst_desc'=> $this->qst_desc,
            ],
            $fieldArray, $messageArray
        );
        if ($validator->fails())
        {
            $questionId = explode('.', $validator->errors()->keys()[0])[1];
            $this->section = Question::where('id', $questionId)->value('department_id');
        }
        $validator->validate();
    }
}
