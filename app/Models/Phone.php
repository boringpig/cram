<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Phone
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $student_phone
 * @property string $parent_phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Phone whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Phone whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Phone whereStudentPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Phone whereParentPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Phone whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Phone whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Phone extends Model
{
	protected $table = 'phones';

	protected $fillable = ['student_id', 'student_phone', 'parent_phone'];

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}
}
