<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $table = 'clients';

	protected $fillable = [
		'id',
		'id_number',
		'first_name',
		'last_name',
		'gender',
		'birthday',
	];

	public function getDeposits()
	{
		return $this->hasMany('App\Deposit','client_id');
	}
}
