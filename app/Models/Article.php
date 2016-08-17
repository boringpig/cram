<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

/**
 * App\Models\Article
 *
 * @property integer $id
 * @property string $title
 * @property string $body
 * @property string $slug
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $user_id
 * @property integer $category_id
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article whereCategoryId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $tags
 */
class Article extends Model
{
	use PresentableTrait;

	protected $presenter = 'App\Presenters\ArticlePresenter';

	protected $table = 'articles';

	protected $fillable = [ 'title', 'body', 'slug', 'user_id', 'category_id', 'tag_id' ];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag', 'article_tag', 'article_id', 'tag_id');
	}

	public function getTagsAttribute()
	{
		return $this->tags()->lists('id')->toArray();
	}
}
