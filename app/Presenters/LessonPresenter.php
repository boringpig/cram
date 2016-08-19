<?php


namespace App\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class LessonPresenter extends Presenter
{

	public function dateFormat()
	{
		$date = new Carbon($this->published_date);

		return $date->format('Y-m-d');
	}
}