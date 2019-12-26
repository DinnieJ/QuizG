<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Contain;
use Auth;
class CollectionController extends Controller
{
    public function all()
    {
        $data = Collection::paginate(6);
        foreach ($data as &$collection){
            $collection->user;
        }

        return response([
            'collections' => $data
        ],200);
    }

    public function getCollectionByUser($user){
        $data = Collection::where('user_id',$user)->get();
        return response([
            'collections' => $data
        ],200);
    }

    public function addQuizToCollection(Request $req ,$id){
        $request = json_decode($req->getContent(),true);
        $new_containent = $request['quizzes_id'];
        foreach($new_containent as $ele){
            Contain::create([
                'quiz_id' => $ele,
                'collection_id' => $id,
            ]);
        }

        return response([
            'message' => 'successful'
        ],200);
    }

    public function removeQuiz($id,$quiz_id){
        $containent = Contain::where([
            'collection_id' => $id,
            'quiz_id' => $quiz_id,
        ])->first();

        if(count($containent) > 0){
            $containent->each->delete();
            return response([
                'message' => 'deleted'
            ],200);
        }

        return response([
            'message' => 'failed',
        ],400);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $request = json_decode($req->getContent(),true);
        Collection::create([
            'user_id' => Auth::user()->id,
            'name' => $request['name'],
        ]); 

        return response([
            'message' => 'Added successful'
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
        $data->setRelation('quizzes',$data->quizzes()->paginate(5));
        foreach($data->quizzes as &$quiz){
            $quiz->setRelation('answers',$quiz->answers);
        }
        //$data = Collection::find(3);

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
    public function update(Request $req, $id)
    {
        $request = json_decode($req->getContent(),true);
        $collection = Collection::find($id);
        $collection->name = $request['name'];
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
        }
        return response([
            'message' => 'Delete successful'
        ],200);

    }
}
