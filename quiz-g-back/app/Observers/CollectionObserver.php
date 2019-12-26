<?php

namespace App\Observers;
use App\Collection;
use App\Contain;
class CollectionObserver
{
    public function deleting(Collection $collection){
        $contains = Contain::where('collection_id',$collection->id)->get();
        $contains->each->delete();
    }
}
