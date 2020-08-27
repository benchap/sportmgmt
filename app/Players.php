<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    protected $guarded = [];

    public function team(){
        return $this->belongsTo(Teams::class, 'team_id');
    }

    //public function user(){
    //    return $this->belongsTo(User::class, 'user_id');
    //}
}
