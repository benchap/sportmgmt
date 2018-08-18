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
                        
                        <div class="form-group row">
                          <label for="smFormGroupInput" class="col-sm-3 col-form-label col-form-label-sm">Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="name" name='name' required value="{{ old('name') }}">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="smFormGroupInput" class="col-sm-3 col-form-label col-form-label-sm">Short Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="short_name" name='short_name' required value="{{ old('short_name') }}">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="smFormGroupInput" class="col-sm-3 col-form-label col-form-label-sm">Start Date</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" id="start_date" name='start_date' required value="{{ old('start_date') }}">
                          </div>
                          <label for="smFormGroupInput" class="col-sm-3 col-form-label col-form-label-sm">End Date</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" id="end_date" name='end_date' required value="{{ old('end_date') }}">
                          </div>
                        </div>


                        <div class="form-group row">
                          <label for="smFormGroupInput" class="col-sm-3 col-form-label col-form-label-sm">Type</label>
                          <div class="col-sm-9">
                                <select class="form-control" id="ctype" name='ctype'>
                                @foreach($categories as $category)
                                    <option value='{{ $category }}'>{{ $category }}</option>
                                @endforeach
                                </select> 
                          </div>
                        </div>


                        <div class="form-group row">
                            <label for="smFormGroupInput" class="col-sm-3 col-form-label col-form-label-sm">Frequency</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="frequency" name='frequency'>
                                @foreach($frequencies as $frequency)
                                    <option value='{{ $frequency }}'>{{ $frequency }}</option>
                                @endforeach
                                </select> 
                            </div>
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
    $( "#end_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
  </script>
@endsection