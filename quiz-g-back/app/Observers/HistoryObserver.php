<?php

namespace App\Observers;
use App\History;
class HistoryObserver
{   
    public function deleting(History $history){
        $history->actions()->get()->each->delete();
    }
}
