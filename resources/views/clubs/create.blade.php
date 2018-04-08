@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new Club</div>

                <div class="panel-body">
                    <form method='POST' action="/clubs">
                        {{ csrf_field() }}
                        
                        <div id="form-group">
                            <label for='title'>Name:</label> 
                            <input type='text' class='form-control' id='name' name='name' required value="{{ old('name') }}">
                        </div>

                       <div id="form-group">
                            <label for='body'>Address1:</label> 
                            <input type='text' class='form-control' id='address1' name='address1' required value="{{ old('address1') }}">
                        </div>

                        <div id="form-group">
                            <label for='body'>Address2:</label> 
                            <input type='text' class='form-control' id='address2' name='address2' value="{{ old('address2') }}">
                        </div>

                        <div id="form-group">
                            <label for='body'>Suburb:</label> 
                            <input type='text' class='form-control' id='suburb' name='suburb' required value="{{ old('suburb') }}">
                        </div>

                        <div id="form-group">
                            <label for='body'>Postcode:</label> 
                            <input type='text' class='form-control' id='postcode' name='postcode' required value="{{ old('postcode') }}">
                        </div>

                        <div id="form-group">
                            <label for='body'>State:</label> 
                            <input type='text' class='form-control' id='state' name='state' required value="{{ old('state') }}">
                        </div>

                        <div id="form-group">
                            <label for='body'>Country:</label> 
                            <input type='text' class='form-control' id='country' name='country' required value="{{ old('country') }}">
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

@section('scripts')
<script>test</script>
@endsection
