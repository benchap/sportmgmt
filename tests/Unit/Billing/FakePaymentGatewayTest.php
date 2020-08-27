<?php

namespace Tests\Unit\Billing;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Billing\FakePaymentGateway;
use App\Billing\FailedPaymentException;

class FakePaymentGatewayTest extends TestCase
{
    use DatabaseMigrations;
/*
    protected $competition;

	public function setUp()
	{
		parent::setUp();
		$this->competition = factory('App\Competition')->create();
	}
*/
	/** @test **/
	public function charges_with_a_valid_payment_token_are_valid()
	{
		# Create new payment gateway
		$paymentGateway = new FakePaymentGateway();

		# Make a payment using a valid test token 
		$paymentGateway->charge(2500, $paymentGateway->getValidToken());
	
		# Check the total charges to see if it equals what we charged
		$this->assertEquals(2500, $paymentGateway->totalCharges());
	}

	/** @test **/
	/* One way to throw exceptions is to annotate at top here
	eg. @expectedException PaymentFailedExeception \App\Billing\PaymentFailedException
	*/
	public function orders_with_an_invalid_token_will_fail()
	{
		try{
			# Create new payment gateway
			$paymentGateway = new FakePaymentGateway();

			# Make a payment using a valid test token 
			$paymentGateway->charge(2500, 'invalid-token');
		}
		catch(FailedPaymentException $e)
		{
			//$this->assertEquals(2500,$this->failedChargesAmount);    //Add extra assertions if this fails
			return;
		}

		#Explicitly fail - A successful test shouldnt reach this point. It should be caught and returned above.
		$this->fail("Order contained invalid token");

	}
}