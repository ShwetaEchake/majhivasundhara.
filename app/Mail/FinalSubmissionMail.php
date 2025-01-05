<?php

namespace App\Mail;

use App\Models\ContestentPd;
use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FinalSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $marks;
    public $paryavaran_marks;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->marks = $data['marks'];
        $this->paryavaran_marks = $data['paryavaran_marks'];
        // $authUser = Auth::user();
        // $questions = Question::withWhereHas('options')->with('department', 'category', 'userSelectedOption')
        //                 ->where(['category_id'=> $authUser->category_id, 'competition_type_id'=> $authUser->competition_type_id])->get();
        // $selected_marks = $questions->pluck('userSelectedOption.marks_obtained', 'userSelectedOption.question_id')->toArray();
        // // $question_id_array = $questions->pluck('id')->toArray();
        // $questions = $questions->groupBy('department_id');


        // $formCount = 1;
        // $name = [];
        // $age = [];
        // $gender = [];
        // $activity = [];
        // // $image = [];
        // $hidden_image = [];
        // $hidden_id = [];
        // $contestentPds = ContestentPd::where('user_id', Auth::user()->id)->get();
        // $is_submitted = auth()->user()->is_submitted;
        // if ($contestentPds->isNotEmpty())
        // {
        //     // $isEditable = 1;
        //     $formCount = $contestentPds->count();
        //     foreach ($contestentPds as $key => $contestentPd)
        //     {
        //         $hidden_id[$key+1] = $contestentPd->id;
        //         $name[$key+1] = $contestentPd->name;
        //         $age[$key+1] = $contestentPd->age;
        //         $gender[$key+1] = $contestentPd->gender;
        //         $activity[$key+1] = $contestentPd->activity;
        //         $hidden_image[$key+1] = $contestentPd->attached_file;
        //     }
        // }
        // // $authUser = Auth::user()->toArray();

        // $path = Pdf::loadView('frontend.contest-one-pdf', ['name'=>$name, 'age'=>$age, 'gender'=>$gender, 'activity'=>$activity, 'hidden_image'=>$hidden_image, 'hidden_id'=>$hidden_id, 'formCount'=>$formCount, 'authUser'=>$authUser, 'selected_marks'=>$selected_marks, 'questions'=>$questions, 'contestentPds'=>$contestentPds, 'is_submitted'=>$is_submitted])->download(public_path('contest.pdf'));

        // dd($path);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Final Submission Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.final-submission-mail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromPath(public_path($this->pdf_path))
            //     ->as('name.pdf')
            //     ->withMime('application/pdf')
        ];
    }
}
