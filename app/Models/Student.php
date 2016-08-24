<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\Models\Student
 *
 * @property integer $id
 * @property boolean $status
 * @property string $name
 * @property string $graduated_school
 * @property string $parent_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Lesson[] $lessons
 * @property-read mixed $student_phone
 * @property-read mixed $parent_phone
 * @property-read mixed $home_address
 * @property-read \App\Models\Phone $phone
 * @property-read \App\Models\Address $address
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Student whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Student whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Student whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Student whereGraduatedSchool($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Student whereParentName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Student whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RollCall[] $rollCalls
 */
class Student extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\StudentPresenter';

	protected $table = 'students';

	protected $fillable = ['phone_id, address_id', 'status', 'name', 'graduated_school', 'parent_name'];

	public function getLessonsAttribute()
	{
		return $this->lessons()->lists('id')->toArray();
	}

	public function getStudentPhoneAttribute()
	{
		return $this->phone->student_phone;
	}

	public function getParentPhoneAttribute()
	{
		return $this->phone->parent_phone;
	}

	public function getHomeAddressAttribute()
	{
		$address = $this->address->home_address;
		return substr($address, 18, 40);
	}

	public function phone()
	{
		return $this->hasOne('App\Models\Phone');
	}

	public function address()
	{
		return $this->hasOne('App\Models\Address');
	}

	public function lessons()
	{
		return $this->belongsToMany('App\Models\Lesson', 'lesson_student', 'student_id', 'lesson_id');
	}

	public function rollCalls()
	{
		return $this->belongsToMany('App\Models\RollCall', 'rollCall_student', 'student_id', 'rollCall_id');
	}
}
