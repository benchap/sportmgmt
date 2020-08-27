<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $guarded = [];

    public function club(){
    	return $this->belongsTo(Club::class);
    }

    public function competition(){
    	return $this->belongsTo(Competition::class);
    }

    # Retrieve the membership orders for this team
    public function membership_orders(){
    	return $this->hasMany(MembershipOrder::class, 'team_id', 'id');
    }

    # Retrieve the membership types for this team
    public function memberships(){
    	return $this->hasMany(Membership::class);
    }

    public function players(){
        return $this->hasMany(Players::class, 'team_id');
    }
}
