@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Competitions</div>

                <div class="panel-body">
                    @foreach ($competitions as $comp)
                    <article>
                        <h4><a href="/competitions/{{$comp->id}}">{{ $comp->name }}</a></h4>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection