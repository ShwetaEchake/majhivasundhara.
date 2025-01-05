<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Question extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'user_id', 'department_id', 'category_id', 'competition_type_id', 'name', 'marks', 'note', 'link_type', 'link', 'created_by', 'updated_by', 'deleted_by' ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function competitionType()
    {
        return $this->belongsTo(CompetitionType::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }
    public function userSelectedOption()
    {
        return $this->hasOne(UserContest::class, 'question_id', 'id')->where('user_id', Auth::user()->id);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
