<?php

namespace App\Http\Controllers;

use App\Billing\FakePaymentGateway;
use App\Billing\FailedPaymentException;
use App\Billing\PaymentGatewayInterface;
use App\Membership;
use App\MembershipOrder;
use App\Teams;
use Illuminate\Http\Request;

class TeamsMembershipController extends Controller
{
    private $paymentGateway;

    /* Typehint PaymentGateway interface so it can be swapped out for production use */
    public function __construct(PaymentGatewayInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $teamID - Team ID which membership was purchased fr
     *          $memberId - Membership ID
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $teamId, $memberId)
    {
        // required fields
        $validData = $request->validate([
            'email' => 'required|email',
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required|max:255',
            'address2' => 'max:255',
            'country' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'DOB' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'emergency_name' => 'required',
            'emergency_phone' => 'required',
            'payment_token' => 'required',
        ]);


        $membership = Membership::find($memberId);          // MemberID - membership plan
        $team = Teams::find($teamId);                       // Team the request is coming from
        $memberType = request('member_type');              // ie. player, coach, volunteer
        $token = request('payment_token');

        // Need to add the remaining fields
        $email = request('email');                          // Player details. Need more
        $user_id = request('user_id');                      // for already signed in 



        // Insert intial order into MembershipOrder
       
     /*
       $team->membership_orders->create(
            'user_id' => auth()->id(),
            'membership_id' => $memberId,
            'status' => 'pending',
            'pay_status' => 'pending',
            'email' => 'email',
       );
       */

       // If signed in, can use this user_id 
       //echo "\nTeamsMembershipController - User id " . auth()->id() . "\n\n";

       // create membership
        $order = MembershipOrder::create([
            'user_id' => $user_id,
            'membership_id' => $memberId,
            'team_id' => $teamId,
            'status' => 'pending',
            'pay_status' => 'pending',
            'email' => $email,
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
            'address' => request('address'),
            'address2' => request('address2'),
            'country' => request('country'),
            'state' => request('state'),
            'postcode' => request('postcode'),
            'city' => request('city'),
            'DOB' => request('DOB'),
            'gender' => request('gender'),
            'phone' => request('phone'),
            'work_phone' => request('work_phone'),
            'emergency_name' => request('emergency_name'),
            'emergency_phone' => request('emergency_phone'),
            'previous_injury' => request('previous_injury'),
        ]); 

        // Generate invoice 

        try{
            // Charge card
            $this->paymentGateway->charge($membership->cost, $token);
        
        }catch(FailedPaymentException $e){
            return response()->json(['errors'=>'A valid payment token is required'], 422);
        }

        // if successful
            // Update invoice to paid
            // Update membership status to paid

        // What about when customer is already signed in?

        return response()->json([], 201);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $teams)
    {
        return view('teams.membership.show', compact('teams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
