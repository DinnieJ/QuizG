<?php

namespace App\Traits;

use App\Contain;
trait QuizService{
    public function isExistInContainent($quiz_id,$collection_id){
        return Contain::where([
            'quiz_id' => $quiz_id,
            'collection_id' => $collection_id
        ])->exists();
    }
}
?>