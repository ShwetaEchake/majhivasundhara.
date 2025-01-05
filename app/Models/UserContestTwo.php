<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserContestTwo extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'user_id', 'department_id', 'question_two_id', 'description', 'picture', 'video', 'marks_obtained' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function selectedQuestion()
    {
        return $this->belongsTo(QuestionTwo::class, 'question_two_id', 'id');
    }

    public function fieldEditedForm()
    {
        return $this->hasOne(FieldEditedFormTwo::class, 'user_contest_two_id', 'id');
    }
}
