@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Team</div>

                <div class="panel-body">
                    <form method='POST' action="/teams/{{ $teams->id }}" enctype='multipart/form-data'>
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        
                        <div id="form-group">
                            <label for='title'>Name:</label> 
                            <input type='text' class='form-control' id='name' name='name' required value="{{ $teams->name }}">
                        </div>
                        <br />
                       <div id="form-group">
                            <label for='body'>Team logo:</label> 
                            <input type='file' class='form-control-file' id='logo' name='logo'>
                        </div>                           

                        <div id='form-group'>
                            <br /><button type='submit' class='btn btn-primary'>Edit</button>
                        </div>

                        @if(count($errors))
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('head')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('footer')
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
@endsection