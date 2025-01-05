<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $fillable = [ 'question_id', 'name', 'marks', 'created_by', 'updated_by', 'deleted_by' ];


    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
