<?php

namespace App\Http\Controllers;

use App\Client;
use App\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
    	$deposits = Deposit::get();
    	return view('deposits', compact('deposits'));
    }

    public function create()
    {
    	$clientsAll = Client::select('id', 'first_name', 'last_name')->get();
    	$clients    = [];
    	foreach ($clientsAll as $cl) {
		    $clients[$cl->id] = $cl->first_name . ' ' . $cl->last_name;
	    }
    	return view('deposit-create', compact('clients'));
    }

    public function store(Request $request)
    {
    	$client = Client::find($request->input('client'));
    	if ($client) {
    		Deposit::create([
    			'client_id' => $client->id,
			    'money_balance' => $request->input('money')
		    ]);
	    }
	    return redirect('deposits');
    }
}
