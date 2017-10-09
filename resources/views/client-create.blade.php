@extends('layout.main')

@section('css')
    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Main content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <div class="panel-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(["url" => "clients/new-client"]) !!}
                            <div class="form-group">
                                {!! Form::label("first_name", "First Name: ", ["class" =>"control-label"]) !!}
                                {!! Form::text("first_name", null, ["class" => "form-control", "required" => "required"] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label("last_name", "Last Name: ", ["class" =>"control-label"]) !!}
                                {!! Form::text("last_name", null, ["class" => "form-control", "required" => "required"]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label("id_number", "ID number: ", ["class" =>"control-label"]) !!}
                                {!! Form::text("id_number", null, ["class" => "form-control", "required" => "required"]) !!}
                            </div>
                            <div class="form-group">
                                <label class="control-label">You Birthday date: </label>
                                <div class="form-group">
                                    <div class='input-group date' id='date-birthday'>
                                        <input id="birthday" name="birthday" type='text' class="form-control" required="required" placeholder="Format: dd-mm-YYYY"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                         </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    {!! Form::select("gender", $gender, '', [
                                           "class"          => "form-control",
                                           "placeholder"    => "Please choose gender",
                                           "required"       => "required",
                                           "id"             => "gender"
                                    ]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Create</button>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('java-script')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js" type="text/javascript"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery.fn.extend({
            size: function() {
                return $(this).length;
            }
        });
        $('#date-birthday').datetimepicker({
            format: 'DD-MM-YYYY',
        });
    </script>
@endsection