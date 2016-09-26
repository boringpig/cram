<?php


namespace App\Repositories;


use App\Models\ClockIn;
use Carbon\Carbon;

class ClockInRepository extends AbstractRepository
{
	/** @var ClockIn $model Model物件 */
	protected $model;


	/**
	 * ClockInRepository constructor.
	 * @param $model
	 */
	public function __construct(ClockIn $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	/**
	 * 存入目前使用者簽到記錄
	 *
	 * @param $time
	 * @param $userObj
	 * @return ClockIn
	 */
	public function UserClockIn($time, $userObj)
	{
	 	$card = new ClockIn();
		$card->user_id = $userObj->id;
		$card->on_duty = $time;
		$card->save();

		return $card;
	}

	/**
	 * 存入目前使用者簽退記錄
	 *
	 * @param Carbon $time
	 * @param array $data
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function UserClockOut(Carbon $time, array $data)
	{
		//找出上班打卡的單子
		$card = $this->model->find($data['card_id']);
		//確認這張打卡單是不是登入本人
		$check = $card->user()->where('id', $data['user_id'])->get();

		if($check){
			$on_duty = new Carbon($card->on_duty);
			$card->off_duty = $time;
			$card->total_hour = $time->diffInHours($on_duty);
			$card->save();
		}

		return $card;
	}
}