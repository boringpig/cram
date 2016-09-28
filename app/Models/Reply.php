<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reply
 *
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Message $message
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Reply whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Reply whereMessageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Reply whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Reply whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Reply whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
