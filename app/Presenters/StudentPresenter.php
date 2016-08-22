<?php


namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class StudentPresenter extends Presenter
{

	public function statusType()
	{
		if ($this->status == 0){
			return '<span class="label label-danger">離班<span>';
		} elseif ($this->status == 1){
			return '<span class="label label-success">在班<span>';
		} elseif ($this->status == 2){
			return '<span class="label label-warning">試聽<span>';
		}
	}

	public function createdDate()
	{
		return $this->created_at->format('Y/m/d');
	}
}