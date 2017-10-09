<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
	protected $table    = 'operations';

	protected $fillable = [
		'name'
	];

	public $timestamps = false;
}
