<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','collection_id','total','correct','type','finished','total_time'
    ];

    public function actions(){
        return $this->hasMany(\App\Action::class);
    }

    public function collection(){
        return $this->belongsTo(\App\Collection::class);
    }

    public function user(){
        return $this->belongsTo(\App\User::class);
    }
}
