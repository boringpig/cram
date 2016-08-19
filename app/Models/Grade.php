<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Grade
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Grade whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Grade whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Grade whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Grade whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Grade extends Model
{
	protected $table = 'grades';

	protected $fillable = ['name'];

	public function lessons()
	{
		return $this->hasMany('App\Models\Lesson');
	}
}
