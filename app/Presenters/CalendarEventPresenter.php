<?php


namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class CalendarEventPresenter extends Presenter
{
	public function url_str()
	{
		if(strlen($this->url) > 50){
			return substr($this->url, 0, 50).'...';
		}else{
			return $this->url;
		}
	}
}