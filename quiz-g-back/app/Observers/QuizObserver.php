<?php

namespace App\Observers;

use App\Quiz;
use App\Contain;
class QuizObserver
{
    public function deleting(Quiz $quiz){
        $quiz->answers()->get()->each->delete();
        Contain::where('quiz_id',$quiz->id)->get()->each->delete();
    }

    public function deleted(){

    }
}
