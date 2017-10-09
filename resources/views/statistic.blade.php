@extends('layout.main')

@section('content')
    <!-- Main content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <a href="/" >back to main</a>
                    <div>
                        <span> In {{date('F', strtotime($statistics['month']))}} bank have $ {{number_format($statistics['diff'], 2, ' ', '.')}} </span>
                    </div>
                    <div class="panel-heading">
                        <div class="form-inline" style="position: relative">
                            <h3> All Statistics</h3>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered" id="table">
                            <thead>
                            <tr>
                                <th>Clients Amount</th>
                                <th>Deposits Amount</th>
                                <th>Money in Bank</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{count($clients)}}</td>
                                    <td>{{$deposits}}</td>
                                    <td>$ {{number_format($money, 2, '.', ' ')}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h3> Statistics by age</h3>
                        <table class="table table-bordered" id="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Age</th>
                                <th>Amount</th>
                                <th>Round</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($ages as $key => $age)
                                    @if ($age['count'])
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$key}}</td>
                                            <td>{{$age['count']}}</td>
                                            <td>{{round($age['money']/$age['deposit'])}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection