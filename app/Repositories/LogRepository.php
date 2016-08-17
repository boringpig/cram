<?php


namespace App\Repositories;


use Spatie\Activitylog\Models\Activity;

class LogRepository
{
	/**
	 * @var Activity
	 */
	private $model;

	/**
	 * EloquentActivity constructor.
	 *
	 * @param Activity $model
	 */
	public function __construct(Activity $model)
	{
		$this->model = $model;
	}

	public function getUserActivityLog(int $user_id)
	{
		return $this->model
			->where('causer_type', 'App\Models\User')
			->where('causer_id', $user_id)
			->paginate(5);
	}

	public function getUserLatestLogin(int $user_id)
	{
		return $this->model
			->where('causer_type', 'App\Models\User')
			->where('causer_id', $user_id)
			->where('description', 'LIKE', '%登入成功%')
			->latest('created_at')
			->first();
	}
}