@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $competition->name }}</div>
                <div class="panel-body">
                    <p>Start Date: {{ $competition->start_date }}</p>
                    <p>
                    <a href="/competitions/{{ $competition->id }}/edit" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Edit</a>
                    </p>
                </div>
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form method='POST' action="/competitions/{{ $competition->id }}/teams">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="form-group"> 
                   <div id="form-group">
                        <label for='title'>Team Name:</label> 
                        <input type='text' class='form-control' id='name' name='name' required value="">
                    </div>
                </div>
                <button type='submit' class='btn btn-default btn-sm'>Add Team</button>
            </form>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Teams</div>
                <div class="panel-body">
                @if(count($competition->teams))
                    @foreach ($competition->teams as $team)
                    <p><a href='/teams/{{$team->id}}'>{{ $team->name }}</a></p>
                    @endforeach
                @else
                    <p>No Teams have been added</p>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection