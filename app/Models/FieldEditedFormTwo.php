<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldEditedFormTwo extends BaseModel
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'user_contest_two_id', 'contestant_user_id', 'description', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'marks', 'latitude', 'longitude' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userContestTwo()
    {
        return $this->belongsTo(UserContestTwo::class);
    }
}
