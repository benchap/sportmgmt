<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompetitionTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
    	parent::setUp();										# Create Competition instance here once.
    	$this->comp = factory('App\Competition')->create();			
    }

    /**  @test */
    public function a_user_can_browse_competitions()
    {
        $this->get('/competitions')								# retrieve a list of all competitions
        	->assertSee($this->comp->name);						# check that the name exists

        $this->get('/competitions/' . $this->comp->id)			# retreive a view competition page
     		->assertSee($this->comp->name);						# check that the name is exists on the page
    }

    /**  @test */
    public function a_user_can_see_teams_within_a_competition()
    {
        
      	$club = factory('App\Teams')->create(['competition_id' => $this->comp->id]);

      	$this->get('/competitions/' . $this->comp->id)
      		->assertSee($club->name);
    }

}