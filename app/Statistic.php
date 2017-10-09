<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
	protected $table    = 'statistics';

	protected $fillable = [
		'name',
		'deposit_id',
		'operation_id',
		'percent',
        'balance_before',
        'percent_sum',
        'balance_after',
	];

}
