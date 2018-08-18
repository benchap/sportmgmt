<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompetitionTest extends TestCase
{
    use DatabaseMigrations;

    protected $competition;

	public function setUp()
	{
		parent::setUp();
		$this->competition = factory('App\Competition')->create();
	}

	/** @test **/
	public function a_competition_has_an_owner()
	{
		$this->assertInstanceOf('App\User', $this->competition->creator);
	}

}
