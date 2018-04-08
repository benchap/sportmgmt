@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new competition</div>

                <div class="panel-body">
                    <form method='POST' action="/competitions">
                        {{ csrf_field() }}
                        
                        <div id="form-group">
                            <label for='title'>Name:</label> 
                            <input type='text' class='form-control' id='name' name='name' required value="{{ old('name') }}">
                        </div>

                       <div id="form-group">
                            <label for='body'>Short Name:</label> 
                            <input type='text' class='form-control' id='short_name' name='short_name' required value="{{ old('short_name') }}">
                        </div>

                        <div id="form-group">
                            <label for='body'>Start Date:</label> 
                            <input type='text' class='form-control' id='start_date' name='start_date' required value="{{ old('start_date') }}">
                        </div>
                        <div id='form-group'>
                            <button type='submit' class='btn btn-primary'>Create</button>
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