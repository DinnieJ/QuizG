<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = "quizzes";
    protected $primaryKey = 'id';

    protected $fillable = ['user_id','content','correct_answer_id'];
}
