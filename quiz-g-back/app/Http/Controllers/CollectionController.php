<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Contain;
use App\Traits\QuizService;
use Auth;
class CollectionController extends Controller
{
    use QuizService;
    public function all()
    {
        $data = Collection::paginate(6);
        foreach ($data as &$collection){
            $collection->user;
            $collection->authorize = (Auth::check() && Auth::user()->id == $collection->user->id);
        }

        return response([
            'collections' => $data
        ],200);
    }

    public function getCollectionByUser($user){
        $data = Collection::where('user_id',$user)->get();
        $data->load('user');
        $authorize = (Auth::check() && $user==Auth::user()->id);
        return response([
            'collections' => $data,
            'authorize' => $authorize,
        ],200);
    }

    public function addQuizToCollection(Request $request ,$id){
        $new_containent = $request->quizzes_id;
        foreach($new_containent as $ele){
            if(!$this->isExistInContainent($ele,$id)){
                Contain::create([
                    'quiz_id' => $ele,
                    'collection_id' => $id,
                ]);
            }
        }

        return response([
            'message' => 'successful'
        ],200);
    }

    public function removeQuiz(Request $request, $id){

        $quizzes_id = $request->quizzes_id;
        if($quizzes_id == null || count($quizzes_id)<=0){
            return response([
                'message' => 'nothing to delete',
            ],400);
        }
        foreach($quizzes_id as $quiz_id){
            $containent = Contain::where([
                'collection_id' => $id,
                'quiz_id' => $quiz_id,
            ])->get();

            if(count($containent) > 0){
                $containent->each->delete();
            }
        }
        return response([
            'message' => 'successful',
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_collection = Collection::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
        ]); 

        return response([
            'message' => 'Added successful',
            'collection' => $new_collection
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
        $data = Collection::find($id,['id','user_id','name']);
        if($data == null){
            return response([
                'message' => 'Collection not found'
            ],400);
        }
        $data->setRelation('quizzes',$data->quizzes()->paginate(5));
        $authorize = (Auth::check() && $data->user_id == Auth::user()->id);

        $data->authorize = $authorize;
        foreach($data->quizzes as &$quiz){
            $quiz->setRelation('answers',$quiz->answers);
            $quiz->authorize = (Auth::check() && $quiz->user_id == Auth::user()->id);
        }

        return response([
            'collection' => $data
        ],200);
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
        $collection = Collection::find($id);
        $collection->name = $request->name;
        $collection->save();

        return response(['message'=> 'edited!'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Collection::find($id);
        if($collection != null){
            $collection->delete();
            return response([
                'message' => 'Delete successful'
            ],200);
        }
        return response([
            'message' => 'Nothing to delete'
        ],400);

    }
}
