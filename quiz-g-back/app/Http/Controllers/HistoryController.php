<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\History;
class HistoryController extends Controller
{
    public function getHistory(){
        $histories = History::where('user_id',Auth::user()->id)->get();
        if($histories == null || count($histories) <= 0){
            return response([
                'message' => 'There is no histories'
            ],400);
        }
        $histories->each->actions;
        foreach($histories as &$history){
            $history->collection;
        }
        return response([
            'histories' => $histories
        ],200);
    }
}
