<?php

namespace App\Models;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\CalendarEventPresenter';

	protected $table = 'calendar_events';

	protected $fillable = ['title', 'start', 'end', 'url', 'background_color'];
}
