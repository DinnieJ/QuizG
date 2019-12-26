<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\History;
class HistoryController extends Controller
{
    public function getHistory(){
        $histories = History::where('user_id',Auth::user()->id)->get();
        $histories->each->actions;

        return response([
            'histories' => $histories
        ],200);
    }
}
