<?php


namespace App\Presenters;


use Laracasts\Presenter\Presenter;
use Storage;

class ArticlePresenter extends Presenter
{

	public function body_str()
	{
		if(strlen(strip_tags($this->body)) > 120){
			return substr(strip_tags($this->body), 0, 100).'...';
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

	public function showImageUrl()
	{
		$url = 'http://placehold.it/700x300';
		$s3 = Storage::cloud();
		if ($s3->has($this->image)){
			$url = $s3->url($this->image);
		}

		return $url;
	}
}