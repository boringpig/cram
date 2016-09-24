<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\MessageRequest;
use App\Http\Requests\Message\ReplayRequest;
use App\Services\MessageService;
use App\Services\ReplayService;
use App\Services\UserService;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Image;
use Storage;

class MessageController extends Controller
{

	/**
	 * @var UserService
	 */
	private $user;
	/**
	 * @var MessageService
	 */
	private $message;
	/**
	 * @var ReplayService
	 */
	private $replay;


	/**
	 * MessageController constructor.
	 *
	 * @param UserService $user
	 * @param MessageService $message
	 * @param ReplayService $replay
	 */
	public function __construct(UserService $user, MessageService $message, ReplayService $replay)
	{
		$this->middleware('auth');
		$this->user = $user;
		$this->message = $message;
		$this->replay = $replay;
	}

	/**
	 * 顯示聯絡我們
	 *
	 * @return mixed
	 */
	public function getContactPage()
	{
		$user = $this->user->showUserById(Auth::user()->id);
		$teacher_list = $this->user->showAllTeacherByArray();

		return view('pages.contact.index', compact('user', 'teacher_list'));
	}

	/**
	 * 發送訊息
	 *
	 * @param MessageRequest $request
	 * @return mixed
	 */
	public function postContactPage(MessageRequest $request)
	{
		$this->message->addMessage($request->all(), Auth::user()->id);
		alert()->success('已傳送訊息')->persistent("關閉");;

		return redirect()->back();
	}

	/**
	 * 顯示聯絡記錄
	 *
	 * @return mixed
	 */
	public function getContactRecord()
	{
		$messages = $this->message->showUserContactRecord();

		return view('pages.contact.record', compact('messages'));
	}

	/**
	 * 顯示單一訊息記錄
	 *
	 * @param $id
	 * @return mixed
	 */
	public function getShowContact($id)
	{
		$message = $this->message->showContactById($id);

		return view('pages.contact.show', compact('message'));
	}

	/**
	 * 回覆訊息
	 *
	 * @param ReplayRequest $request
	 * @return mixed
	 */
	public function postReplayContact(ReplayRequest $request)
	{
		$this->replay->addReplay($request->all());

		return redirect()->back();
	}

	/**                      
	 * 上傳回覆的圖片
	 * 
	 * @param Request $request
	 * @return mixed
	 */
	public function postUploadImage(Request $request)
	{
		$file = $request->file('image');
		$filename = time(). '.jpg';
		$image = (string) Image::make($file)->encode('jpg', 75)->resize(400, 400);
		$filePath = 'contact/' . $filename;
		$s3 = Storage::cloud();
		$s3->put($filePath, $image, 'public');

		return mce_back($filename);
	}
}
