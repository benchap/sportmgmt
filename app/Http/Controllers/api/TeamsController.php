<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Teams;
use App\Http\Resources\TeamsResource;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $teams = Teams::paginate(15);
        return TeamsResource::collection($teams);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = $request->isMethod('put')   
            ? Teams::findOrFail($request->team_id)
            : new Teams;
        // Retrieve form params
        $team->id = $request->input('team_id');
        $team->name = $request->input('name');

        // Save and return new resource
        if($team->save()){
            return new TeamsResource($team);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve club
        $team = Teams::findOrFail($id);

        // Remove the data field from json output
        TeamsResource::withoutWrapping();

        // Return a single club as a resource
        return new TeamsResource($team);
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
        // Retrieve club
        $team = Teams::findOrFail($id);

        // Delete club
        if($team->delete()){
            return new TeamsResource($team);
        }
    }
}
