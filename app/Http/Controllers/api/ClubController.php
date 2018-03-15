<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Club;
use App\Http\Resources\ClubResource;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $clubs = Club::paginate(15);
        return ClubResource::collection($clubs);
        // return new ClubsResource
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
        $club = $request->isMethod('put')   
            ? Club::findOrFail($request->club_id)
            : new Club;
        // Retrieve form params
        $club->id = $request->input('club_id');
        $club->name = $request->input('name');

        // Save and return new resource
        if($club->save()){
            return new ClubResource($club);
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
        $club = Club::findOrFail($id);

        // Remove the data field from json output
        ClubResource::withoutWrapping();

        // Return a single club as a resource
        return new ClubResource($club);
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
        $club = Club::findOrFail($id);

        // Delete club
        if($club->delete()){
            return new ClubResource($club);
        }
    }
}
