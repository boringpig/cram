<?php


namespace App\Repositories;


use App\Models\Reply;
use Mews\Purifier\Facades\Purifier;

class ReplayRepository extends AbstractRepository
{
	/** @var Reply $model */
	protected $model;

	/**
	 * ReplayRepository constructor.
	 *
	 * @param Reply $model
	 */
	public function __construct(Reply $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	/**
	 * 新增回覆訊息
	 *
	 * @param $data
	 * @param $user_id
	 * @param $message_id
	 * @return Reply
	 */
	public function createReplay($data, $user_id, $message_id)
	{
		$replay = new Reply();
		$replay->message_id = $message_id;
		$replay->user_id = $user_id;
		$replay->content = Purifier::clean($data['content']);
		$replay->save();

		return $replay;
	}
}