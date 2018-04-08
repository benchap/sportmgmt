<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ClubTest extends TestCase
{
    use DatabaseMigrations;

    /**  @test */
    public function a_user_can_browse_clubs()
    {
        
        $club = factory('App\Club')->create();

    }

    /** @test */
    public function an_authenticated_user_can_create_a_club()
    {
        // create a new user and sign in using actingAs()
        $this->signIn();  

        // Make a club object
        $club = factory('App\Club')->make();

        // Hit the create club endpoint passing the club as parameters
        $response = $this->post('/clubs', $club->toArray());
            
        // The post redirects to club index on success.
        // Get redirect page and check that club name exists
        $this->get($response->headers->get('Location'))
            ->assertSee($club->name);

    }
}
