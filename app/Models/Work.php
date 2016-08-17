<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{

	protected $table = 'works';

	protected $fillable = ['name'];

	public function clockIns()
	{
		return $this->belongsToMany('App\Models\ClockIn', 'clockIn_work', 'work_id', 'clockIn_id');
	}
}
