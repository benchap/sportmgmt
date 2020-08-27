<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamsAPITest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function a_team_can_be_retrieved()
    {

        // Create a team
        $team = factory('App\Teams')->create();


        // GET team endpoint
        $response = $this->json('GET', '/api/teams');


        $response->assertStatus(200);

        $response->assertJsonFragment([ 'name' => $team->name ]);
    }
}
