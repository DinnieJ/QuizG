<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'actions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'history_id','quiz_id','answer_id','right','time'
    ];
}
