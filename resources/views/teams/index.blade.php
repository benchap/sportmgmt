@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Teams</div>

                <div class="panel-body">
                    @foreach ($teams as $team)
                    <article>
                        <h4>{{ $team->name }}</h4>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection