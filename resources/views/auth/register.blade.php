@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
                            <label for="position" class="col-md-4 control-label">Position</label>

                            <div class="col-md-6">
                                <input id="position" type="text" class="form-control" name="position" value="{{ old('position') }}" required autofocus>

                                @if ($errors->has('position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @role('admin')
                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="" class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role">
                                    <option value="1">Admin</option>
                                    <option value="2">Level 0</option>
                                    <option value="3">Level 1</option>
                                </select>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-4 control-label">Designation</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role" id="designation">
                                    <option value="1">College</option>
                                    <option value="2">Office</option>
                                </select>
                            </div>
                        </div>

                        <div class="office form-group hidden">
                            <label for="" class="col-md-4 control-label">Office</label>

                            <div class="col-md-6">
                                <select class="form-control" name="office_id" id="offices">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="college form-group hidden">
                            <label for="" class="col-md-4 control-label">College</label>

                            <div class="col-md-6">
                                <select class="form-control" name="college_id" id="colleges">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="college form-group hidden">
                            <label for="" class="col-md-4 control-label">Department</label>

                            <div class="col-md-6">
                                <select class="form-control" name="department_id" id="departments">
                                    
                                </select>
                            </div>
                        </div>
                        @endrole

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_scripts')

    <script>

            $('#designation').on('change', function(e){
                var val = e.target.value;
                
                if(val == 2){
                    $('.office').removeClass('hidden');
                    $('.college').addClass('hidden');
                    $.get('/get-offices', function(data) {
                        $('#offices').empty();
                        $.each(data, function(index,subCatObj){
                            $('#offices').append('<option value="'+subCatObj.id+'">'+subCatObj.description+'</option>');
                        });
                        $("#offices").prepend("<option value='0' selected='selected'></option>").val('');
                    });
                }

                if(val == 1){
                    $('.college').removeClass('hidden');
                    $('.office').addClass('hidden');
                    $.get('/get-colleges', function(data) {
                        $('#colleges').empty();
                        $.each(data, function(index,subCatObj){
                            $('#colleges').append('<option value="'+subCatObj.id+'">'+subCatObj.description+'</option>');
                        });
                        $("#colleges").prepend("<option value='0' selected='selected'></option>").val('');
                    });
                }

            });

            $('#colleges').on('change', function(e){
                var val = e.target.value;
                
                    $.get('/get-departments?college_id=' + val, function(data) {
                        $('#departments').empty();
                        $.each(data, function(index,subCatObj){
                            $('#departments').append('<option value="'+subCatObj.id+'">'+subCatObj.description+'</option>');
                        });
                        $("#departments").prepend("<option value='0' selected='selected'></option>").val('');
                    });
                
            });
    </script>

@endsection
