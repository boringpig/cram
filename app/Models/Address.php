<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
	protected $table = 'addresses';

	protected $fillable = ['student_id', 'home_address'];

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}
}
