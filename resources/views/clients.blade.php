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
                            <h3> Table of Clients</h3>
                            <a href="/clients/new-client" style="position: absolute; right: 10px" class="btn-default"> Add</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered" id="table">
                            <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>ID number</th>
                                <th>Money Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->first_name}}</td>
                                    <td>{{$client->last_name}}</td>
                                    <td>{{$client->id_number}}</td>
                                    <td>{{$client->getDeposits->sum('money_balance')}}$</td>
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