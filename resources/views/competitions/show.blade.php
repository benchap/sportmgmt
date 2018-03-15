@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $competition->name }}</div>

                <div class="panel-body">
                    <p>Start Date: {{ $competition->start_date }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Teams</div>
                @foreach ($competition->teams as $team)
                <div class="panel-body">{{ $team->name }}</div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection