<?php

namespace App\Http\Controllers;

use App\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
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
        return view('competitions.create');
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
            //'channel_id' => 'required|exists:channels,id'
        ]);

        // dd will dump $request data (and halt) in phpunit, similar to datadump in perl 
        // dump() will do the same but not halt.
        // dd($request->all());
        $competition = Competition::create([
            //'user_id' => auth()->id(),              // created by user
            'name' => request('name'),
            'short_name' => request('short_name'),
            'start_date' => request('start_date'),
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
        return view('competitions.edit', compact('competition'));
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
            //'channel_id' => 'required|exists:channels,id'
        ]);

        // dd will dump $request data (and halt) in phpunit, similar to datadump in perl 
        // dump() will do the same but not halt.
        // dd($request->all());
        $competition->update([
            //'user_id' => auth()->id(),              // created by user
            'name' => request('name'),
            'short_name' => request('short_name'),
            'start_date' => request('start_date'),
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
