<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionTwo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'user_id', 'department_id', 'category_id', 'name', 'marks', 'note', 'link_type', 'link' ];

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


    public function options()
    {
        return $this->hasMany(OptionTwo::class);
    }
}
