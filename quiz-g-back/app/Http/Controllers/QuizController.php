<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Contain;
use App\Answer;
use Auth;
class QuizController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $request = json_decode($req->getContent(),true);
        $correct_answer_id = -1;
        $answers = &$request['answers'];
        $new_quiz = Quiz::create([
            'user_id' => Auth::user()->id,
            'content' => $request['content'],
            'correct_answer_id' => $correct_answer_id,
            'time' => $request['time'],
        ]);
        foreach($answers as $answer){
            
            $new_answer = Answer::create([
                'quiz_id' => $new_quiz->id,
                'content' => $answer['content'],
            ]);
            if(isset($answer['correct']) && $answer['correct'] == 1){
                $correct_answer_id = $new_answer->id;
            }
        }

        $new_quiz->correct_answer_id = $correct_answer_id;
        $new_quiz->save();

        if(isset($request['collection_id'])){
            Contain::create([
                'collection_id' => $request['collection_id'],
                'quiz_id' => $new_quiz->id,
            ]);
        }

        return response([
            'message' => 'Added'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::find($id);
        $quiz->answers;

        return response(['quiz' => $quiz],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
