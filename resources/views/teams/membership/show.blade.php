@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $teams->name }} Registration</div>
                <div class="panel-body">
                    <p>Membership: </p>
                    
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Players</div>
                <div class="panel-body">
   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection