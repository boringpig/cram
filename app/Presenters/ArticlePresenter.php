<?php


namespace App\Presenters;


use Laracasts\Presenter\Presenter;

class ArticlePresenter extends Presenter
{

	public function body_str()
	{
		if(strlen($this->body)>100){
			return substr($this->body, 0, 100).'...';
		}else{
			return $this->body;
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