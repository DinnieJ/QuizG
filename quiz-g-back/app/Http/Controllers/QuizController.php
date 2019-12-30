<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Contain;
use App\Answer;
use Auth;
/**
 * Quiz controller
 * 
 * @category Controller
 * @package  Controllers
 * @author   Nguyen Ngoc Dat <dat.nguyen@impl.vn>
 * @license  none QUIZ_G
 * @link     https://gitlab.impl.vn/duy.do/quizg
 */
class QuizController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $correct_answer_id = -1;
        $answers = $request->answers;
        $new_quiz = Quiz::create(
            [
            'user_id' => Auth::user()->id,
            'content' => $request->content,
            'correct_answer_id' => $correct_answer_id,
            'time' => $request->time,
            ]
        );
        foreach ($answers as $answer) {
            
            $new_answer = Answer::create(
                [
                'quiz_id' => $new_quiz->id,
                'content' => $answer['content'],
                ]
            );
            
            if (isset($answer['correct']) && $answer['correct'] == 1) {
                $correct_answer_id = $new_answer->id;
            }
        }

        $new_quiz->correct_answer_id = $correct_answer_id;
        $new_quiz->save();

        if (isset($request->collection_id)) {
            Contain::create([
                'collection_id' => $request->collection_id,
                'quiz_id' => $new_quiz->id,
                ]
            );
        }

        return response([
            'message' => 'Added'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::find($id);
        if($quiz == null){
            return response([
                'message' => 'Quiz not found'
            ],400);
        }
        $quiz->answers;

        return response(['quiz' => $quiz], 200);
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
    public function update($id,Request $request)
    {
        $quiz = Quiz::find($id);
        $quiz->content = $request->content;

        $quiz->answers()->get()->each->delete();

        $correct_answer_id = -1;
        $answers = $request->answers;
        
        foreach ($answers as &$answer) {
            $new_answer = Answer::create(
                [
                'quiz_id' => $quiz->id,
                'content' => $answer['content'],
                ]
            );
            if (isset($answer['correct']) && $answer['correct'] == 1) {
                $correct_answer_id = $new_answer->id;
            }
        }
        $quiz->time = $request->time;
        $quiz->correct_answer_id = $correct_answer_id;
        $quiz->save();

        return response([
            'message' => 'edited',
            'quiz' => $quiz,
            ], 200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        if ($quiz != null) {
            $quiz->delete();
            return response([
                'message' => 'Delete'
            ],200);
        }

        return response([
            'message' => 'quiz not found'
            ], 400
        );
    }

    public function getQuizByUser($id){
        $quiz = Quiz::where('user_id',$id)->get();
        if($quiz == null || count($quiz) <= 0){
            return response([
                'message' => 'Quiz not found or empty'
            ],400);
        }

        $quiz = $quiz->load('answers');

        return response([
            'quizzes' => $quiz
        ],200);
    }
}
