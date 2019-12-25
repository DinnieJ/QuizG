<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collections';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','name'
    ];

    public function quizzes(){
        return $this->belongsToMany(\App\Quiz::class,'contains');
    }

    public function user(){
        return $this->belongsTo(\App\User::class);
    }
}
