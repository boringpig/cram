<?php


namespace App\Http\ViewComposers;

use Auth;
use Illuminate\View\View;
use App\Repositories\UserRepository;

class AvatarComposer
{

	/**
	 * @var UserRepository
	 */
	private $user;

	/**
	 * AvatarComposer constructor.
	 *
	 * @param UserRepository $user
	 */
	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}

	/**
	 * Bind data to the view.
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$avatar_url = $this->user->getUserAvatarById(Auth::user()->id);
		$view->with('avatar_url', $avatar_url);
	}
}