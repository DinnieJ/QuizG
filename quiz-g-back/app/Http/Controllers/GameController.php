<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Collection;
use App\History;
use App\Traits\QuizGHelper;
use Auth;
class GameController extends Controller
{
    use QuizGHelper;
    public function getGameData($id){
        $history_id = -1;
        $data = $this->getData($id);

        if(Auth::check()){
           $new_history =  History::create([
                'user_id' => Auth::user()->id,
                'collection_id' => $id,
                'total' => 0,
                'correct' => 0,
                'type' =>  'GAME',
                'finished' => 0,
            ]);

            $history_id = $new_history->id;
        }
        return response([
            'collection' => $data,
            'loggedin' => Auth::check(),
            'history_id'=> $history_id
        ],200);
    }




    public function submitGame(Request $request){
        if(Auth::check()){

            $history_id = $request->history_id;
            $this->wrappingUp($history_id);
            $detail = $this->getHistory($history_id);
            return response([
                'message' => 'finished game',
                'detail' => $detail
            ],200);
        }
    }




    public function gradingQuiz(Request $request){
        $quiz_id = $request->id;
        
        $answer_id = $request->answer_id;
        $history_id = $request->history_id;
        $result = $this->checkAnswer($quiz_id,$answer_id);
        $time = $request->time;
        if($history_id != -1){

            $this->addAction($history_id,[
                'quiz_id' => $quiz_id,
                'answer_id' => $answer_id,
                'right' => $result,
                'time' => $time,
            ]);
        }
        return response([
            'result' => $result,
        ],200);
    }
}
