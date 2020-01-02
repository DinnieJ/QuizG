<?php

namespace App\Http\Controllers\Admin;

class AdminController{
    public function getAllUser(){
        $users = User::all();

        return response([
            'users' => $users
        ],200);
    }

    public function getAllCollections(){
        $collections = Collection::all();

        return response([
            'collections' => $collections
        ],200);
    }    
}

?>