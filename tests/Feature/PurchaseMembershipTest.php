<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Billing\FakePaymentGateway;
use App\Billing\PaymentGatewayInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundataion\Testing\AssertionsTrait;
use Illuminate\Foundataion\Testing\TestResponse;

class PurchaseMembershipTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();

        //Create a paymentGateway
        $this->paymentGateway = new FakePaymentGateway;

        // Fixes - BindingResolutionException, Laravel needs this linkage.
        $this->app->instance(PaymentGatewayInterface::class, $this->paymentGateway);

        $this->team = factory('App\Teams')->create();
        $this->membership = factory('App\Membership')->create();
    }

    private function orderMembership($team, $membership, $params)
    {
        $response = $this->json("POST", "/teams/{$team->id}/register/{$membership->id}", $params);
        return $response;
    }

    /** @test */
    public function member_can_register_for_a_team()
    {
        // Signed in? Review whether the process should involve initial signup??
        // Initial thoughts, no. 
        $a = "PurchaseMembershipTest.php ";
        // sign in as user
        $this->signIn();
                
        // Charge the customer
        //$paymentGateway->charge(13500, $paymentGateway->getValidToken());

        //dd("/teams/{$team->id}/register/{$membership->id}");
        // Act - membership signup
        // Register as a player via a team
        $response = $this->orderMembership($this->team, $this->membership, [
            'member_type' => 'player',
            'payment_token' => $this->paymentGateway->getValidToken(),
            'email' => 'john@doe.com',
            'user_id' => auth()->id(),
            'firstname' => 'John',
            'lastname' => 'Doe',
            'address' => '1 Victory St',
            'address2' => '',
            'country' => 'Australia',
            'state' => 'NSW',
            'postcode' => '2570',
            'city' => 'Narellan',
            'DOB' => '2011-03-30',
            'gender' => 'Male',
            'phone' => '0400 000 000',
            'work_phone' => '02 8894 1000',
            'emergency_name' => 'Jane Doe',
            'emergency_phone' => '02 9904 1000',
            'previous_injury' => '',
        ]);

        // Assert a created response
        $response->assertStatus(201);

        // Has user has paid the correct amount. Use Stripe API to retrieve charges?
        $this->assertEquals(13500, $this->paymentGateway->totalCharges());

        // A membership/order was created for the user. Ensure the object is not null.
        $order = $this->team->membership_orders->where('email', 'john@doe.com')->first();
        $this->assertNotNull($order);

        // The user is associated with a team. 
        //$this->assertTrue($teams->players->contains(function($player){
        //    $player->email == 'john@doe.com';
        //});
    
    }

    /** @test */
    public function email_is_required_to_order_memberships(){

        $this->withExceptionHandling()->signIn();
        
        // Charge the customer
        //$paymentGateway->charge(13500, $paymentGateway->getValidToken());

        $response = $this->orderMembership($this->team, $this->membership, [
            'member_type' => 'player',
            'payment_token' => $this->paymentGateway->getValidToken(),
            'user_id' => auth()->id(),
            'firstname' => 'John',
            'lastname' => 'Doe',
            'address' => '1 Victory St',
            'address2' => '',
            'country' => 'Australia',
            'state' => 'NSW',
            'postcode' => '2570',
            'city' => 'Narellan',
            'DOB' => '2011-03-30',
            'gender' => 'Male',
            'phone' => '0400 000 000',
            'work_phone' => '02 8894 1000',
            'emergency_name' => 'Jane Doe',
            'emergency_phone' => '02 9904 1000',
            'previous_injury' => '',
        ]);

        $response->assertStatus(422)
                ->assertJsonFragment(['email' => ["The email field is required."]]);

        // Decodes json response into array
        //dd($response->decodeResponseJson());

    }

    /** @test */
    public function must_be_a_valid_email_address_to_purchase_membership()
    {
        $this->withExceptionHandling()->signIn();

        // Register as a player via a team
        $response = $this->orderMembership($this->team,$this->membership, [
            'member_type' => 'player',
            'payment_token' => $this->paymentGateway->getValidToken(),
            'user_id' => auth()->id(),
            'email' => 'an_invalid_email',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'address' => '1 Victory St',
            'address2' => '',
            'country' => 'Australia',
            'state' => 'NSW',
            'postcode' => '2570',
            'city' => 'Narellan',
            'DOB' => '2011-03-30',
            'gender' => 'Male',
            'phone' => '0400 000 000',
            'work_phone' => '02 8894 1000',
            'emergency_name' => 'Jane Doe',
            'emergency_phone' => '02 9904 1000',
            'previous_injury' => '',
        ]);

        $response->assertStatus(422)
                ->assertJsonFragment(['email' => ["The email must be a valid email address."]]);

        // Decodes json response into array
        //dd($response->decodeResponseJson());
    }

    /** @test */
    public function a_payment_token_is_required_to_purchase_membership()
    {
        $this->withoutExceptionHandling()->signIn();

        // Register as a player via a team
        $response = $this->orderMembership($this->team,$this->membership, [
            'member_type' => 'player',
            'user_id' => auth()->id(),
            'firstname' => 'John',
            'lastname' => 'Doe',
            'address' => '1 Victory St',
            'address2' => '',
            'country' => 'Australia',
            'state' => 'NSW',
            'postcode' => '2570',
            'city' => 'Narellan',
            'DOB' => '2011-03-30',
            'gender' => 'Male',
            'phone' => '0400 000 000',
            'work_phone' => '02 8894 1000',
            'emergency_name' => 'Jane Doe',
            'emergency_phone' => '02 9904 1000',
            'previous_injury' => '',
            'payment_token' => 'invalid-payment-token',
            'email' => 'john@doe.com'
        ]);

        dd($response->decodeResponseJson());
        
        $response->assertStatus(422)
                ->assertJsonFragment(['payment_token' => ["The payment token field is required."]]);

        // Decodes json response into array
        dd($response->decodeResponseJson());
    }

    /** @test */
    public function a_membership_is_not_created_if_payment_fails()
    {
        $this->withExceptionHandling()->signIn();

        // Register as a player via a team
        $response = $this->orderMembership($this->team,$this->membership, [
            'member_type' => 'player',
            'payment_token' => 'invalid_payment_token',
            'user_id' => auth()->id(),
            'email' => 'john@doe.com',
            'firstname' => 'John',
            'lastname' => 'Doe',
            'address' => '1 Victory St',
            'address2' => '',
            'country' => 'Australia',
            'state' => 'NSW',
            'postcode' => '2570',
            'city' => 'Narellan',
            'DOB' => '2011-03-30',
            'gender' => 'Male',
            'phone' => '0400 000 000',
            'work_phone' => '02 8894 1000',
            'emergency_name' => 'Jane Doe',
            'emergency_phone' => '02 9904 1000',
            'previous_injury' => '',
        ]);

        // Unprocessable
        $response->assertStatus(422);
        
        // Ensure that a membership wasnt created
        $order = $this->team->membership_orders->where('email', 'john@doe.com')->first();
        $this->assertNull($order);
    }
}
