<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth')->except(['index','show']);       // will protect any new functions
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = Competition::latest()->get();
        return view('competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = array("Rounds","Knockout","Mixed");
        $frequencies = array("Weekly","Monthly","Custom");
        return view('competitions.create')
                    ->with(compact('categories'))
                    ->with(compact('frequencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'short_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'ctype' => 'required',
            'frequency' => 'required'
            //'channel_id' => 'required|exists:channels,id'
        ]);
    

        // dd will dump $request data (and halt) in phpunit, similar to datadump in perl 
        // dump() will do the same but not halt.
        // dd($request->all());
        $competition = Competition::create([
            'user_id' => auth()->id(),              // created by user
            'name' => request('name'),
            'short_name' => request('short_name'),
            'start_date' => request('start_date'),
            'end_date' => request('end_date'),
            'frequency' => request('frequency'),
            'ctype' => request('ctype'),
        ]);

        return redirect('/competitions');
        //$thread->path();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        //Route model binding with the id passed in.
        return view('competitions.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        $categories = array("Rounds","Knockout","Mixed");
        $frequencies = array("Weekly","Monthly","Custom");
        return view('competitions.edit', compact('competition'))
                ->with(compact('categories'))
                ->with(compact('frequencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        $this->validate($request, [
            'name' => 'required',
            'short_name' => 'required',
            'start_date' => 'required',
            'ctype' => 'required',
            'frequency' => 'required'
            //'channel_id' => 'required|exists:channels,id'
        ]);

        // dd will dump $request data (and halt) in phpunit, similar to datadump in perl 
        // dump() will do the same but not halt.
        // dd($request->all());
        $competition->update([
            'user_id' => auth()->id(),              // created by user
            'name' => request('name'),
            'short_name' => request('short_name'),
            'start_date' => request('start_date'),
            'ctype' => request('ctype'),
            'frequency' => request('frequency'),
        ]);

        return redirect('/competitions/' . $competition->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Competition  $competition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        //
    }

}
