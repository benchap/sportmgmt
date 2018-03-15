@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Clubs</div>

                <div class="panel-body">
                    @foreach ($clubs as $club)
                    <article>
                        <h4>{{ $club->name }}</h4>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
