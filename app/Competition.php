<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
	protected $guarded = [];

  	public function teams()
  	{	
  		return $this->hasMany(Teams::class);
  	}

  	public function addTeam(Teams $team)
  	{
  		$this->teams()->create($team);
  	}
}
