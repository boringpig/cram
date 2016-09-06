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

	public function addMessage(array $data, int $user_id)
	{
		$message = $this->messageRepository->createMessage($data, $user_id);
		Event::fire(new MessageSent($message));

		return $message;
	}

	public function showUserContactRecord()
	{
		return $this->messageRepository->getUserContactRecord(Auth::user()->id);
	}

	public function showContactById($id)
	{
		return $this->messageRepository->getContactById($id);
	}


}