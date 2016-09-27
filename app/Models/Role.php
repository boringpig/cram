<?php


namespace App\Models;

use Laracasts\Presenter\PresentableTrait;
use Zizaco\Entrust\EntrustRole;

/**
 * App\Models\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $perms
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\RolePresenter';

	protected $fillable = ['name', 'display_name', 'description'];

	public function users()
	{
		return $this->belongsToMany('App\Models\User', 'role_user', 'role_id', 'user_id');
	}

	public function permissions()
	{
		return $this->belongsToMany('App\Models\Permission', 'permission_role', 'role_id', 'permission_id');
	}

	public function getPermissionsAttribute()
	{
		return $this->permissions()->lists('id')->toArray();
	}

}