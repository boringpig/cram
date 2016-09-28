<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\Models\Message
 *
 * @property integer $id
 * @property integer $message_id
 * @property integer $user_id
 * @property integer $teacher_id
 * @property string $email
 * @property string $title
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereMessageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereTeacherId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
