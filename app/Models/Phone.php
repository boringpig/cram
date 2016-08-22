<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
	protected $table = 'phones';

	protected $fillable = ['student_id', 'student_phone', 'parent_phone'];

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}
}
