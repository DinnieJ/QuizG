<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Validator;
use App\Traits\AdminService;
use Auth;
class AdminController{
    use AdminService;
    public function allUser(){
        $users = $this->getAllUser();
        return view('users.index')->with('users',$users);
    }


    public function allCollection(){
        $collections = $this->getAllCollection();

        return view('collections.index')->with('collections',$collections);
        
    }


    public function allQuiz(){
        $quizzes = $this->getAllQuiz();

        return view('quizzes.index')->with('quizzes',$quizzes);
    }


    public function allHistory(){
        $histories = $this->getAllHistory();
        $histories->load('collection');
        $histories->load('user');
        //dd($histories);
        return view('history.index')->with('histories',$histories);
    }
    

    public function detailCollection($id){
        $data = $this->showCollection($id);

        return view('collections.item')->with('collection',$data);
    }

    public function detailQuiz($id){
        $quiz = $this->showQuiz($id);

        return view('quizzes.item')->with('quiz',$quiz);
    }

    public function detailUser($id){
        $data = $this->showUser($id);
        return view('users.item')
        ->with('user',$data['user'])
        ->with('collections',$data['collections'])
        ->with('quizzes',$data['quizzes'])
        ->with('histories',$data['histories']);
    }
}

?>