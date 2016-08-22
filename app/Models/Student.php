<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

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
}
