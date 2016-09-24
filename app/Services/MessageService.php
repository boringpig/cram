<?php


namespace App\Services;


use App\Events\MessageSent;
use App\Repositories\MessageRepository;
use Auth;
use Illuminate\Support\Facades\Event;

class MessageService
{

	/**
	 * @var MessageRepository
	 */
	private $messageRepository;

	/**
	 * MessageService constructor.
	 *
	 * @param MessageRepository $messageRepository
	 */
	public function __construct(MessageRepository $messageRepository)
	{
		$this->messageRepository = $messageRepository;
	}

	/**
	 * 新增訊息
	 *
	 * @param array $data
	 * @param int $user_id
	 * @return \App\Models\Message
	 */
	public function addMessage(array $data, int $user_id)
	{
		$message = $this->messageRepository->createMessage($data, $user_id);
		Event::fire(new MessageSent($message));

		return $message;
	}

	/**
	 * 顯示個人訊息記錄
	 *
	 * @return mixed
	 */
	public function showUserContactRecord()
	{
		return $this->messageRepository->getUserContactRecord(Auth::user()->id);
	}

	/**
	 * 顯示單一訊息記錄
	 *
	 * @param $id
	 * @return mixed
	 */
	public function showContactById($id)
	{
		return $this->messageRepository->getContactById($id);
	}


}