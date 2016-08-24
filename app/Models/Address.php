<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Address
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $home_address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereHomeAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Address whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
	protected $table = 'addresses';

	protected $fillable = ['student_id', 'home_address'];

	public function student()
	{
		return $this->belongsTo('App\Models\Student');
	}
}
