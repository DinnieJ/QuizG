<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contain extends Model
{
    protected $table = 'contains';
    protected $primaryKey = 'id';

    protected $fillable = [
        'quiz_id','collection_id'
    ];
}
