@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p>
                <a href="/teams/create" class="btn btn-primary btn-sm" role="button" aria-disabled="true">
                    Create Team
                </a>
            </p>
            <div class="panel panel-default">
                <div class="panel-heading">Teams</div>
                <div class="panel-body">
                    @foreach ($teams as $team)
                    <article>
                        <h4><a href="/teams/{{ $team->id }}">{{ $team->name }}</a></h4>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection