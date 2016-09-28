<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RollCall
 *
 * @property-read \App\Models\Lesson $lessons
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $lesson_id
 * @property string $name
 * @property string $teacher
 * @property string $class_time
 * @property string $date
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Lesson $lesson
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereLessonId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereTeacher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereClassTime($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RollCall whereUpdatedAt($value)
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
