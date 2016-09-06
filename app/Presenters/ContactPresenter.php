<?php


namespace App\Presenters;


use App\Models\User;
use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class ContactPresenter extends Presenter
{

	public function showTeacherName()
	{
		$user = User::where('id', $this->teacher_id)->first();

		return $user->name;
	}

	public function created_type()
	{
		return Carbon::parse($this->created_at)->format('Y/m/d');
	}
}