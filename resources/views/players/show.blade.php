@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Player Profile: {{ $players->firstname }} {{ $players->lastname}}</div>
                <div class="panel-body">
                    <p>First Name: {{ $players->firstname }}</p>
                    <p>Surname: {{ $players->lastname }} </p>
                    <p>Email: </p>
          
                    <p>
                        <a href="/players/{{ $players->id }}/edit" class="btn btn-primary btn-sm" role="button" aria-disabled="true">
                            Edit
                        </a>
                    </p>
                 
                </div>
            </div>
        </div>
    </div> 
</div>
@endsection