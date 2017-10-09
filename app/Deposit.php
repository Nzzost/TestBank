<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
	protected $table = 'deposits';

	protected $fillable = [
		'id',
		'client_id',
		'money_balance',
        'percent',
	];

	public function getClient()
	{
		return $this->belongsTo('App\Client', 'client_id');
	}
}
