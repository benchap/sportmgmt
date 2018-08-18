<?php

namespace App\Http\Controllers;

use App\Teams;
use App\Competition;
use App\Image;
use App\Jobs\ProcessImageThumbnail;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Teams::latest()->get();
        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Competition $competition)
    {

        $this->validate($request,[
                'name' => 'required',
        ]);

        // Create the team object
        $teams = Teams::create([
            'user_id' => auth()->id(),
            'name' => request('name'),
            'competition_id' => $competition->id,
            'club_id' => 0,                             // change database to be default 0
        ]);

        return back();                                  // used to create teams from the /admin section  
        // redirect
        //return redirect('/teams');                    // used to create teams from club page
                        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function show(Teams $teams)
    {
        return view('teams.show', compact('teams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function edit(Teams $teams)
    {
        return view('teams.edit', compact('teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teams $teams)
    {
        $this->validate($request, [
            'name' => 'required',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input['imagename'] = '';
        // Upload image if the user has provided one
        if($request->hasFile('logo'))
        {
            $image = $request->file('logo');
            $name = time();
            $input['imagename'] = $name.'.'.$image->getClientOriginalExtension();  
            $input['thumbname'] = $name.'_thumb.'.$image->getClientOriginalExtension();  
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $input['imagename']);
           // dd(public_path()."/images/".$input['imagename']);

            // defer the processing of the image thumbnails
            ProcessImageThumbnail::dispatch(public_path()."/images/".$input['imagename'],public_path()."/images/".$input['thumbname'] );
        }
    
        $teams->update([
            //'user_id' => auth()->id(),              // created by user
            'name' => request('name'),
            'logo' => $input['imagename'] ? '/images/'.$input['imagename'] : $teams->logo,
        ]);

        return redirect('/teams/' . $teams->id)->with('success','Team successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teams  $teams
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teams $teams)
    {
        //
    }
}
