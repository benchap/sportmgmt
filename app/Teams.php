<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    public function club(){
    	return $this->belongsTo(Club::class);
    }

    public function competition(){
    	return $this->belongsTo(Competition::class);
    }
}
