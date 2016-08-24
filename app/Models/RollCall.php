<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RollCall
 *
 * @property-read \App\Models\Lesson $lessons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @mixin \Eloquent
 */
class RollCall extends Model
{
	protected $table = 'rollCalls';

	protected $fillable = ['lesson_id', 'name', 'teacher', 'class_time', 'date'];

	public function lesson()
	{
		return $this->belongsTo('App\Models\Lesson');
	}

	public function students()
	{
		return $this->belongsToMany('App\Models\Student', 'rollCall_student', 'rollCall_id', 'student_id')
					->withPivot('rollCall_id', 'student_id', 'status', 'description');
	}

}
