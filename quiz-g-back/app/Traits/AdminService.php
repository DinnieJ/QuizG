<?php
namespace App\Traits;

use App\Quiz;
use App\Collection;
use App\History;
use App\Answer;
use App\User;

trait AdminService{
    public function getAllCollection(){
        $collections = Collection::all();
        $collections->load('user');
        return $collections;
    }

    public function getAllQuiz(){
        $quizzes = Quiz::all();
        $quizzes->load('user');
        return $quizzes;
    }

    public function getAllUser(){
        $users = User::all();

        return $users;
    }

    public function getAllHistory(){
        $histories = History::all();

        return $histories;
    }

    public function showCollection($collection_id){
        $collection = Collection::findOrFail($collection_id);

        $collection->load('quizzes');
        $collection->quizzes->each->load('user');

        return $collection;
    }

    public function showQuiz($id){
        $quiz = Quiz::findOrFail($id);

        $quiz->load('answers');
        $quiz->load('user');;

        return $quiz;
    }

    public function showUser($id){
        $data = [];
        $data['user'] = User::find($id);
        $data['collections'] = $this->getCollectionByUser($id);
        $data['quizzes'] = $this->getQuizByUser($id);
        $data['histories'] = $this->getHistoryByUser($id);

        return $data;
    }

    private function getCollectionByUser($id){
        $collections = Collection::where('user_id',$id)->get();

        $collections->load('user');

        return $collections;
    }

    private function getQuizByUser($id){
        $quizzes = Quiz::where('user_id',$id)->get();

        $quizzes->load('user');

        return $quizzes;
    }

    private function getHistoryByUser($id){
        $histories = History::where('user_id',$id)->get();

        $histories->load('user');
        $histories->load('collection');
        return $histories;
    }
}
?>