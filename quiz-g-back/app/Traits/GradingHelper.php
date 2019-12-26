<?php

namespace App\Traits;

use App\Quiz;
use App\Action;
use App\History;
trait GradingHelper{
    public function checkAnswer($quiz_id,$answer_id){
        $quiz = Quiz::find($quiz_id);
        
        $result = 0;
        if($answer_id == $quiz->correct_answer_id){
            $result = 1;
        }
        return $result;
    }

    public function addAction($history_id,array $action){
        $new_action = Action::create([
            'history_id' => $history_id,
            'quiz_id' => $action['quiz_id'],
            'answer_id' => $action['answer_id'],
            'right' => $action['right'],
            'time' => $action['time']
        ]);
    }

    public function wrappingUp($history_id){
        $history = History::find($history_id);

        $history->finished = 1;
        $actions = $history->actions;

        $total = count($actions);
        $correct = 0;
        foreach($actions as $action){
            if($action->right == 1){
                $correct++;
            }
        }

        $history->total = $total;
        $history->correct = $correct;
        

        $history->save();

    }
}

?>