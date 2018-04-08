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
                        <img width='100' src='/images/{{ $teams->logo }}'> 
                    @endif
                    <p>
                        <br />
                        <a href="/teams/{{ $teams->id }}/edit" class="btn btn-primary btn-sm" role="button" aria-disabled="true">Edit</a>
                    </p>

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