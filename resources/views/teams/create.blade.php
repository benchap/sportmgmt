@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method='POST' action="/teams">
                        {{ csrf_field() }}
                        
                        <div class="form-group row">
                          <label for="smFormGroupInput" class="col-sm-3 col-form-label col-form-label-sm">Team Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="name" name='name' required value="{{ old('name') }}">
                          </div>
                        </div>

                        <div id='form-group'>
                            <button type='submit' class='btn btn-primary'>Create</button>
                        </div>

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