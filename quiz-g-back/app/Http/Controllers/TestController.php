<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\QuizGHelper;
use App\History;
use Auth;

class TestController extends Controller
{
    use QuizGHelper;

    public function getTest($id){
        $data = $this->getData($id);
        return response([
            'collection' => $data
        ],200);
    }

    public function submitTest(Request $request){
        $correct = 0;
        $data = $request->data;
        $total = count($data);
        $new_history = History::create([
            'user_id' => Auth::user()->id,
            'collection_id' => $request->collection_id,
            'total' => $total,
            'correct' => $correct,
            'type' => 'TEST',
            'finished' => 1
        ]);

        $history_id = $new_history->id;
        
        foreach($data as $ele){
            $right = 0;
            if(isset($ele['answer_id']) && $this->checkAnswer($ele['quiz_id'], $ele['answer_id'])){
                $correct++;
                $right = 1;
            }
            $this->addAction($history_id,[
                'quiz_id' => $ele['quiz_id'],
                'answer_id'=> $ele['answer_id'],
                'right' => $right,
                'time' => null
            ]);
        }

        $new_history->correct = $correct;
        $new_history->save();

        $sendbackHistory = History::find($history_id);

        $sendback = $sendbackHistory->load('actions');

        return response([
            'histories' => $sendback,
            'total' => $total,
            'correct' => $correct
        ],200);

        
    }
}
