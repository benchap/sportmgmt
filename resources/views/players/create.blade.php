@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">Add Player to Team {{ $teams->name }}</div>
                <div class="panel-body">
              
                  <form method='POST' action="/teams/{{ $teams->id }}/players">
                      {{ csrf_field() }}
                      {{ method_field('post') }}
                      <div class="form-group">
                          <div id="form-group">
                              <label for='title'>Player Firstname:</label>
                              <input type='text' class='form-control' id='firstname' name='firstname' required value="">

                              <label for='title'>Player Lastname:</label>
                              <input type='text' class='form-control' id='lastname' name='lastname' required value="">

                              <label for='title'>Players Email:</label>
                              <input type='text' class='form-control' id='email' name='email' required value=""> 


                          </div>
                      </div>
                      <button name='submit' type='submit' value='add' class='btn btn-primary btn-sm'>Add Player</button>
                      <button name='submit' type='submit' value='addanother' class='btn btn-secondary btn-sm'>Add Player & Create Another</button>
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
    $( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
@endsection