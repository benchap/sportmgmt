<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClubTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->club = factory('App\Club')->create();
    }
    /**  @test */
    public function a_user_can_browse_clubs()
    {
        $this->get('/clubs')                        # check club results page
            ->assertSee($this->club->name);

        $this->get('/clubs/' . $this->club->id)     # check club view page
            ->assertSee($this->club->name);
    }
}
