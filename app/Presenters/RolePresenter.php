<?php


namespace App\Presenters;


use Laracasts\Presenter\Presenter;

class RolePresenter extends Presenter
{

	public function showTeacherRole()
	{
		if (preg_match("/\老師/i", $this->name)){
			return $this->name . PHP_EOL;
		}
	}
}