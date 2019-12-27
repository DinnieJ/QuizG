<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'content','quiz_id'
    ];

    protected $hidden = [
        'created_at','updated_at'
    ];
}
