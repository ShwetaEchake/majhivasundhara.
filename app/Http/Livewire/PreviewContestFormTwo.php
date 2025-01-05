<?php

namespace App\Http\Livewire;

use App\Models\{QuestionTwo, UserContestTwo};
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PreviewContestFormTwo extends Component
{
    public $question_id_array = [];
    public $section = 6;
    // FORM PROPERTIES
    public $description, $picture, $video;

    public function render()
    {
        $authUser = Auth::user();
        $questions = QuestionTwo::with('department', 'category')->get();
        $questions = $questions->groupBy('department_id');

        $userAnswers = UserContestTwo::where('user_id', $authUser->id)->get();

        if ($userAnswers->isNotEmpty())
        {
            foreach ($userAnswers as $answer) {
                $this->picture[$answer->question_two_id] = $answer->picture;
                $this->video[$answer->question_two_id] = $answer->video;
                $this->description[$answer->question_two_id] = $answer->description;
            }
        }

        return view('livewire.preview-contest-form-two')->with(['questions'=> $questions]);
    }

    public function stepForward()
    {
        $this->section++;
    }
    public function stepBack()
    {
        $this->section--;
    }
}
