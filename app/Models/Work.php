<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Work
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ClockIn[] $clockIns
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Work whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Work whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Work whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Work whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Work extends Model
{

	protected $table = 'works';

	protected $fillable = ['name'];

	public function clockIns()
	{
		return $this->belongsToMany('App\Models\ClockIn', 'clockIn_work', 'work_id', 'clockIn_id');
	}
}
