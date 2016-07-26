<?php


namespace App\Presenters\User;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
	public function accountType()
	{
		return ucfirst($this->entity->account_type) . ' 登入';
	}

	public function createdDate()
	{
		return $this->entity->created_at->format('Y/m/d');
	}

}