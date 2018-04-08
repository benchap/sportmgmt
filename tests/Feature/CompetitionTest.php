<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompetitionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_authenticated_user_can_create_a_competition()
    {

        // sign in as user
        $this->signIn();

        // Create a competition object
        $comp = factory('App\Competition')->make();

        // Send a post request to the create page
        $response = $this->post('/competitions',$comp->toArray());

        // Get the redirected url (competitions view page) and check that the comp name exists
        $this->get($response->headers->get('Location'))
            ->assertSee($comp->name);
            //->assertSee($comp->shortname)       // chain these commands

    }

    public function a_guest_cannot_create_a_competition()
    {

    }

}