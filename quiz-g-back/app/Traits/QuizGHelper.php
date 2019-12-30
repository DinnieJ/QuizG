<?php

namespace App\Traits;

use App\Quiz;
use App\Action;
use App\History;
use App\Collection;
trait QuizGHelper{

    public function getData($id){
        $data = $data = Collection::find($id);
        $data->setRelation('quizzes',$data->quizzes()->inRandomOrder()->get());
        foreach($data->quizzes as &$quiz){
            unset($quiz->correct_answer_id);
            $quiz->setRelation('answers',$quiz->answers()->inRandomOrder()->get());
        }
        return $data;
    }


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
        $time = 0;
        foreach($actions as $action){
            if($action->right == 1){
                $correct++;
            }
            $time += $action->time;
        }

        $history->total = $total;
        $history->correct = $correct;
        $history->total_time = $time;

        $history->save();

        return $history;

    }

    public function getHistory($history_id){
        $history = History::find($history_id);

        $sendback = $history->load('actions');

        return $history;
    }
}

?>