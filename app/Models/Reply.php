<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
	protected $table = 'replies';

	protected $fillable = ['message_id', 'user_id', 'content'];

	public function message()
	{
		return $this->belongsTo('App\Models\Message');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
