@extends('layout.main')

@section('content')
    <!-- Main content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary ">
                    <a href="/" >back to main</a>
                    <div class="panel-heading">
                        <div class="form-inline" style="position: relative">
                            <h3> Table of Deposits</h3>
                            <a href="/deposits/new-deposit" style="position: absolute; right: 10px" class="btn-default"> Add</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered" id="table">
                            <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Deposit ID</th>
                                <th>Money</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($deposits as $deposit)
                                <tr>
                                    <td>{{$deposit->getClient->first_name}} {{$deposit->getClient->last_name}}</td>
                                    <td>{{$deposit->id}}</td>
                                    <td>{{$deposit->money_balance}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection