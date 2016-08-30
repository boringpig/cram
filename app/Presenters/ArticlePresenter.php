<?php


namespace App\Presenters;


use Laracasts\Presenter\Presenter;

class ArticlePresenter extends Presenter
{

	public function body_str()
	{
		if(strlen(strip_tags($this->body)) > 120){
			return substr(strip_tags($this->body), 0, 120).'...';
		}else{
			return strip_tags($this->body);
		}
	}

	public function createDateType()
	{
		return date('M j, Y', strtotime($this->created_at));
	}

	public function updateDateType()
	{
		return date('M j, Y', strtotime($this->updated_at));
	}
}