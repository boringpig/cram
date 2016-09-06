<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Message extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\ContactPresenter';

	protected $table = 'messages';

	protected $fillable = ['title', 'content', 'email', 'user_id'];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function replies()
	{
		return $this->hasMany('App\Models\Reply');
	}
}
