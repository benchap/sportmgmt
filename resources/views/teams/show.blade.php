@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $teams->name }}</div>
                <div class="panel-body">
                    <p>Logo: </p>
                    @if($teams->logo)
                        <img width='100' src='{{ $teams->logo }}'> 
                    @endif
                    <p>
                        <br />
                        <a href="/teams/{{ $teams->id }}/edit" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Edit</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p>
                <a href="/teams/{{$teams->id}}/players/create" class="btn btn-primary btn-sm" role="button" aria-disabled="true">
                    Add Player
                </a>
            </p>
            <div class="panel panel-default">
                <div class="panel-heading">Players</div>
                <div class="panel-body">
                    @if(count($teams->players))
                        @foreach ($teams->players as $player)
                            <p><a href='/teams/{{$teams->id}}/players/{{$player->id}}'>{{ $player->firstname }} {{ $player->lastname }}</a></p>
                        @endforeach
                    @else
                        <p>No Players exist in this team</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

