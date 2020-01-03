<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = "quizzes";
    protected $primaryKey = 'id';

    protected $fillable = ['user_id','content','correct_answer_id','time'];

    protected $hidden = [
        'created_at','updated_at'
    ];


    public function answers(){
        return $this->hasMany(\App\Answer::class);
    }

    public function user(){
        return $this->belongsto(\App\User::class);
    }
}
