<?php

namespace App\Http\Livewire;

use App\Models\{QuestionTwo, UserContestTwo};
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\{Auth, DB, Log, Validator};

class ContestForm2 extends Component
{
    use WithFileUploads;

    public $isEditable = 0;
    public $section = 6;

    // FORM PROPERTIES
    public $question_ids, $picture, $video, $description;
    public $hidden_picture, $hidden_video;


    public function render()
    {
        $authUser = Auth::user();
        $questions = QuestionTwo::with('department', 'category')->get();
        $questions = $questions->groupBy('department_id');

        $userAnswers = UserContestTwo::where('user_id', $authUser->id)->get();

        if ($userAnswers->isNotEmpty())
        {
            $this->isEditable = 1;
            foreach ($userAnswers as $answer) {
                $this->hidden_picture[$answer->question_two_id] = $answer->picture;
                $this->hidden_video[$answer->question_two_id] = $answer->video;
                $this->description[$answer->question_two_id] = $answer->description;
            }
        }

        return view('livewire.contest-form2')->with(['questions' => $questions]);
    }


    public function submitForm($actionType)
    {
        if(!$this->description)
            return redirect()->route('/');

        $questions = '';
        $this->addValidate(array_keys($this->description));
        $questions = QuestionTwo::whereIn('id', array_keys($this->description))->get();


        if ($this->isEditable) {
            try {
                $user = Auth::user();

                DB::beginTransaction();
                foreach ($questions as $question)
                {
                    UserContestTwo::updateOrCreate([
                        'question_two_id' => $question->id,
                        'user_id' => $user->id,
                        'department_id' => $question->department_id,
                    ], [
                        'description' => $this->description[$question->id],
                        'picture' => array_key_exists($question->id, $this->picture ?? []) ? $this->picture[$question->id]->store('user_files') : (array_key_exists($question->id, $this->hidden_picture) ? $this->hidden_picture[$question->id] : ''),
                        'video' => array_key_exists($question->id, $this->video ?? []) ? $this->video[$question->id]->store('user_files') : (array_key_exists($question->id, $this->hidden_video) ? $this->hidden_video[$question->id] : ''),
                    ]);
                }
                DB::commit();

                if($actionType == 'submit')
                    DB::table('users')->where('id', Auth::user()->id)->update(['is_submitted'=> '1']);

                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => $actionType == 'submit' ? 'तुमचा फॉर्म यशस्वीरित्या सबमिट केला गेला आहे' : 'तुमचा मसुदा यशस्वीरित्या सेव्ह झाला.']);
                return redirect()->route('marks');
            } catch (Exception $e) {
                Log::info($e);
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'text' => 'तुमचा फॉर्म सबमिट करताना काहीतरी चूक झाली.']);
            }
        } else {
            try {
                $user = Auth::user();

                DB::beginTransaction();
                foreach ($questions as $question)
                {
                    UserContestTwo::create([
                        'user_id' => $user->id,
                        'department_id' => $question->department_id,
                        'question_two_id' => $question->id,
                        'description' => $this->description[$question->id],
                        'picture' => array_key_exists($question->id, $this->picture ?? []) ? $this->picture[$question->id]->store('user_files') : '',
                        'video' => array_key_exists($question->id, $this->video ?? []) ? $this->video[$question->id]->store('user_files') : '',
                    ]);
                }
                DB::commit();

                if($actionType == 'submit')
                    DB::table('users')->where('id', Auth::user()->id)->update(['is_submitted'=> '1']);

                $this->dispatchBrowserEvent('swal:modal', ['type' => 'success', 'text' => $actionType == 'submit' ? 'तुमचा फॉर्म यशस्वीरित्या सबमिट केला गेला आहे' : 'तुमचा मसुदा यशस्वीरित्या सेव्ह झाला.']);
                return redirect()->route('marks');
            } catch (Exception $e) {
                Log::info($e);
                $this->dispatchBrowserEvent('swal:modal', ['type' => 'error', 'text' => 'तुमचा फॉर्म सबमिट करताना काहीतरी चूक झाली.']);
            }
        }
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
            foreach ($questionIdArray as $id)
            {
                $fieldArray['description.' . $id] = 'required';
                // if (!array_key_exists($id, $this->hidden_picture)) {
                //     $fieldArray['picture.' . $id] = 'nullable';
                //     $fieldArray['video.' . $id] = 'nullable';
                //     $messageArray['picture.' . $id . '.nullable'] = 'Please upload picture';
                //     $messageArray['video.' . $id . '.nullable'] = 'Please upload video';
                // }
                $messageArray['description.' . $id . '.required'] = 'Please enter short description';
            }
            $validator = Validator::make(
                [
                    'description' => $this->description,
                    'picture' => $this->picture,
                    'video' => $this->video,
                ],
                $fieldArray,
                $messageArray
            );
            if ($validator->fails()) {
                $questionId = explode('.', $validator->errors()->keys()[0])[1];
                $this->section = QuestionTwo::where('id', $questionId)->value('department_id');
                $this->dispatchBrowserEvent('validate:scroll-to', [ 'query' => '[name="'.$validator->errors()->keys()[0].'"]'  ]);
            }
            $validator->validate();
        } else {
            $this->resetErrorBag();
            $fieldArray = [];
            $messageArray = [];
            foreach ($questionIdArray as $id) {
                $fieldArray['description.' . $id] = 'required';
                // $fieldArray['picture.' . $id] = 'required';
                // $fieldArray['video.' . $id] = 'required';

                $messageArray['description.' . $id . '.required'] = 'Please enter short description';
                // $messageArray['picture.' . $id . '.required'] = 'Please upload picture';
                // $messageArray['video.' . $id . '.required'] = 'Please upload video';
            }
            $validator = Validator::make(
                [
                    'description' => $this->description,
                    'picture' => $this->picture,
                    'video' => $this->video,
                ],
                $fieldArray,
                $messageArray
            );
            if ($validator->fails())
            {
                $questionId = explode('.', $validator->errors()->keys()[0])[1];
                $this->section = QuestionTwo::where('id', $questionId)->value('department_id');
                $this->dispatchBrowserEvent('validate:scroll-to', [ 'query' => '[name="'.$validator->errors()->keys()[0].'"]'  ]);
            }
            $validator->validate();
        }
    }

}
