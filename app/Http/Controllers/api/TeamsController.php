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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$team = $request->isMethod('put')
        //    ? Teams::findOrFail($request->team_id)
        //    : new Teams;

        $team = Teams::findOrFail($request->team_id);

        $data = $request->post();

        // Retrieve form params
        $team->fill($data);

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
     * @param int $id
     *  @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->post();

        $team = Teams::findOrFail($id);

        // This will update team with the fields provided in $data
        $team->fill($data);

        if($team->save()){
            return TeamsResource($team);
        }

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
