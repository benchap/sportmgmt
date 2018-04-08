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

    /** @test */
    public function an_authenticated_user_can_create_teams()
    {
    	$this->signIn();

    	$team = factory('App\Teams')->make();

//    	$response = $this->post('/teams',$team->toArray());

    	//$this->get($response->headers->get('Location'))
    	//	->assertSee($team->name);

    }
}