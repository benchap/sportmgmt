@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <p>
                    <a href="/teams/create" class="btn btn-primary btn-sm" role="button" aria-disabled="true">
                        Add Player
                    </a>
                </p>
                <div class="panel panel-default">
                    <div class="panel-heading">Players</div>

                    <div class="panel-body">
                        @foreach ($players as $player)
                            <article>
                                <h4>{{ $player->name }}</h4>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection