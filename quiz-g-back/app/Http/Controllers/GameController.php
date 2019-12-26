<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Collection;
use App\History;
use App\Traits\GradingHelper;
use Auth;
class GameController extends Controller
{
    use GradingHelper;

    public function getGameData($id){
        $history_id;
        $data = Collection::find($id);
        $data->setRelation('quizzes',$data->quizzes);
        foreach($data->quizzes as &$quiz){
            $quiz->setRelation('answers',$quiz->answers);
        }

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




    public function submitGame(Request $req){
        if(Auth::check()){
            $request = json_decode($req->getContent(),true);


            $history_id = $request['history_id'];
            $this->wrappingUp($history_id);

            return response([
                'message' => 'finished game',
            ],200);
        }
    }




    public function gradingQuiz(Request $req){
        $request = json_decode($req->getContent(),true);
        $quiz_id = $request['id'];
        
        $answer_id = $request['answer_id'];
        $history_id = $request['history_id'];
        $result = $this->checkAnswer($quiz_id,$answer_id);
        $time = $request['time'];
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
            'key' => $history_id,
        ],200);
    }
}
