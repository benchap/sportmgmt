<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
  	public function teams()
  	{	
  		return $this->hasMany(Teams::class);
  	}
}
