<?php

namespace App\Models;

use Laracasts\Presenter\PresentableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CalendarEvent
 *
 * @property integer $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $url
 * @property string $background_color
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereStart($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereBackgroundColor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\CalendarEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CalendarEvent extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\CalendarEventPresenter';

	protected $table = 'calendar_events';

	protected $fillable = ['title', 'start', 'end', 'url', 'background_color'];
}
