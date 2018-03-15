<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(){
        parent::setUp();
        $this->team = factory('App\Teams')->create();
    }

    
    public function a_user_can_browse_teams()
    {
        $this->get('/teams')                        # check club results page
            ->assertSee($this->team->name);

        //$this->get('/teams/' . $this->team->id)     # check club view page
        //    ->assertSee($this->team->name);
    }
}
