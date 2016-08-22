<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\Models\Lesson
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $grade_id
 * @property string $classNo
 * @property string $name
 * @property string $description
 * @property \Carbon\Carbon $published_date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Grade $grade
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Time[] $times
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereGradeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereClassNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson wherePublishedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Lesson whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lesson extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\LessonPresenter';

	protected $table = 'lessons';

	protected $fillable = ['grade_id', 'user_id', 'classNo', 'name', 'description', 'published_date'];

	protected $dates = ['published_date'];

	public function setPublishedDateAttribute($date)
	{
		$this->attributes['published_date'] = Carbon::createFromFormat('Y-m-d', $date);
	}

	public function getPublishedDateAttribute($date)
	{
		return Carbon::parse($date)->format('Y-m-d');
	}

	public function getTimesAttribute()
	{
		return $this->times()->lists('id')->toArray();
	}

	public function grade()
	{
		return $this->belongsTo('App\Models\Grade');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function times()
	{
		return $this->belongsToMany('App\Models\Time', 'lesson_time', 'lesson_id', 'time_id');
	}

	public function students()
	{
		return $this->belongsToMany('App\Models\Student', 'lesson_student', 'lesson_id', 'student_id');
	}
}
