<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_browse_teams()
    {

    }

    /** @test 
	A team is created from the competitions page
    */
    public function an_authenticated_user_can_add_a_team()
    {
        $this->signIn();
        
    	//create a team and cpompetition object
    	$team = factory('App\Teams')->make();

    	//send data to form endpoint
        $response = $this->post("/competitions/{$team->competition_id}/teams", $team->toArray());

        // team name should appear on page.
        $this->get("/competitions/{$team->competition_id}")
            ->assertSee($team->name);
            
    }

}