<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
	protected $guarded = [];
	
    public function teams(){
    	return $this->hasMany(Teams::class);
    }
}
