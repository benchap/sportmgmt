<?php

namespace App\Http\Controllers;

use App\Teams;
use App\Players;
use Illuminate\Http\Request;

class PlayersController extends Controller
{

    public function index()
    {
        $players = Players::latest()->get();
        return view('players.index', compact('players'));
    }

    public function store(Request $request, Teams $teams)
    {

        $this->validate($request,[
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',    
        ]);

        // User should be created based on email

        // Create player
        $player = Players::create([
            'firstname' => request('firstname'),
            'lastname' => request('lastname'),
            'team_id' => $teams->id,
        ]);

        // single add, return to team page
        if($request->submit == "add"){
            return redirect("/teams/{$teams->id}");
        }

        // add another player
        return back();                                  // used to create teams from the /admin section
    }


    public function create(Teams $teams){
        return view('players.create', compact('teams'));
    }

    public function show(Teams $teams, Players $players){
        return view('players.show', compact('players','teams'));
    }
}
