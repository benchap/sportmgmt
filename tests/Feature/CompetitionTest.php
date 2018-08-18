<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompetitionTest extends TestCase
{
    use DatabaseMigrations;


    /** @test **/
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

    /** @test **/
    public function a_guest_cannot_create_a_competition()
    {
        $this->withExceptionHandling();

        // Check to see if the guest can access the competitions form
        $this->get('/competitions/create')
            ->assertRedirect('/login');

        // Guest shouldnt be able to hit create endpoint 
        $this->post('/competitions')
            ->assertRedirect('/login');
    }


    /** @test **/   
    public function a_competition_must_have_a_name()
    {   
        $this->withExceptionHandling()->signIn();

        $competition = factory('App\Competition')->make([ 'name' => null ]);

        $this->post('/competitions', $competition->toArray())
            ->assertSessionHasErrors('name');
        
    }


/*
            $this->withExceptionHandling();

        // Unable to view create form
        $this->get('/threads/create')
            ->assertRedirect('/login');

        // Unable to create thread
        $this->post('/threads')
            ->assertRedirect('/login');
*/
}