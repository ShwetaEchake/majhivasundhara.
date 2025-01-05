<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserContest extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'user_id', 'department_id', 'question_id', 'group_id', 'option_id', 'document_1', 'document_2', 'description', 'marks_obtained' ];


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
        return $this->belongsTo(Question::class, 'question_id', 'id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }

    public function fieldEditedForm()
    {
        return $this->hasOne(FieldEditedFormOne::class, 'user_contest_id', 'id');
    }

    // public function document_1() : Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => asset('storage/product/'.$value),
    //     );
    // }
    // public function document_2() : Attribute
    // {
    //     return new Attribute(
    //         get: fn ($value) => $value ? asset('storage/product/'.$value) : '',
    //     );
    // }

}
