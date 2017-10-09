<?php

namespace App\Http\Controllers;

use App\Client;
use Validator;
use Illuminate\Http\Request;

class ClientController extends Controller
{
	public function index()
	{
		$clients = Client::get();
		return view('clients', compact('clients'));
	}

	public function create()
	{
		$gender = ['female', 'male'];
		return view('client-create', compact('gender'));
	}

	public function store(Request $request)
	{
		$rule       = ['id_number' => 'unique:clients,id_number'];
		$validator  = Validator::make($request->all(), $rule);
		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}
		Client::create([
			'first_name'    => $request->input('first_name'),
			'last_name'     => $request->input('last_name'),
			'id_number'     => $request->input('id_number'),
			'gender'        => $request->input('gender'),
			'birthday'      => date('Y-m-d H:i:s', strtotime($request->input('birthday'))),
		]);

		return redirect('clients');
	}
}
