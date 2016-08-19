<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Time
 *
 * @property integer $id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Time whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Time whereDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Time whereStartTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Time whereEndTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Time whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Time whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Time extends Model
{
	protected $table = 'times';

	protected $fillable = ['day', 'start_time', 'end_time'];

	public function lessons()
	{
		return $this->belongsToMany('App\Models\Lesson', 'lesson_time', 'time_id', 'lesson_id');
	}
}
