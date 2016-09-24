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

	/**
	 * 顯示全部使用者的使用記錄
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getAllUserActivityLog()
	{
		return $this->model
			->with('causer')
			->orderBy('created_at', 'DESC')
			->paginate(8);
	}

	/**
	 * 查詢使用者個人的使用記錄
	 *
	 * @param int $user_id
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function getUserActivityLog(int $user_id)
	{
		return $this->model
			->where('causer_type', 'App\Models\User')
			->where('causer_id', $user_id)
			->orderBy('created_at', 'DESC')
			->paginate(8);
	}

	/**
	 * 查詢使用者最近登入時間
	 *
	 * @param int $user_id
	 * @return \Illuminate\Database\Eloquent\Model|mixed|null|static
	 */
	public function getUserLatestLogin(int $user_id)
	{
		return $this->model
			->where('causer_type', 'App\Models\User')
			->where('causer_id', $user_id)
			->where('description', 'LIKE', '%登入成功%')
			->orderBy('created_at', 'DESC')
			->first();
	}
}