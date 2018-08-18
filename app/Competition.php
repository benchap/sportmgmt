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

  	public function addTeam($team)
  	{
  		$this->teams()->create($team);
  	}

  	public function creator()
  	{
  		return $this->belongsTo(User::class, 'user_id');
   	}
}
