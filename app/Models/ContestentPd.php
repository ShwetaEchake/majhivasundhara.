<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContestentPd extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'name', 'age', 'gender', 'activity', 'attached_file' ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
