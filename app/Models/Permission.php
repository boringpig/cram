<?php


namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * App\Models\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{
	protected $fillable = ['name', 'display_name', 'description'];

	public function roles()
	{
		return $this->belongsToMany('App\Models\Role', 'permission_role', 'permission_id', 'role_id');
	}

}