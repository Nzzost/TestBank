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
                        {!! Form::open(["url" => "deposits/new-deposit"]) !!}
                            <div class="form-group">
                                <div class="form-group">
                                    {!! Form::select("client", $clients, '', [
                                           "class"          => "form-control",
                                           "placeholder"    => "Please choose client",
                                           "required"       => "required",
                                           "id"             => "client"
                                    ]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label("money", "Your cum of money: ", ["class" =>"control-label"]) !!}
                                {!! Form::text("money", null, ["class" => "form-control", "required" => "required"]) !!}
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