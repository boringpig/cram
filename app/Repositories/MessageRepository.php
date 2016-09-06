<?php


namespace App\Repositories;


use App\Models\Message;
use Mews\Purifier\Facades\Purifier;

class MessageRepository extends AbstractRepository
{
	/** @var Message $model */
	protected $model;

	/**
	 * MessageRepository constructor.
	 *
	 * @param Message $model
	 */
	public function __construct(Message $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function createMessage(array $data, int $user_id)
	{
		$message = new Message();
		$message->message_id = time();
		$message->user_id = $user_id;
		$message->teacher_id = $data['teacher'];
		$message->email = $data['email'];
		$message->title = $data['title'];
		$message->content = Purifier::clean($data['content']);
		$message->save();

		return $message;
	}

	public function getUserContactRecord(int $id)
	{
		return Message::where('user_id', $id)->orWhere('teacher_id', $id)->paginate(8);
	}

	public function getContactById($id)
	{
		return $this->model->where('message_id', $id)->first();
	}

}