<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ClockIn
 *
 * @property integer $id
 * @property integer $user_id
 * @property \Carbon\Carbon $on_duty
 * @property \Carbon\Carbon $off_duty
 * @property integer $total_hour
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\JobType[] $types
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClockIn whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClockIn whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClockIn whereOnDuty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClockIn whereOffDuty($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClockIn whereTotalHour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClockIn whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ClockIn whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Work[] $works
 * @property-read \App\Models\User $user
 */
class ClockIn extends Model
{

	protected $table = 'clockIns';

	protected $fillable = ['user_id', 'on_duty', 'off_duty', 'total_hour'];

	protected $dates = ['on_duty', 'off_duty'];

	public function works()
	{
		return $this->belongsToMany('App\Models\Work', 'clockIn_work', 'clockIn_id', 'work_id')
					->withPivot('clockIn_id', 'work_id', 'hour');
    }

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
