<?php


namespace App\Repositories;


use App\Models\Article;

class ArticleRepository extends AbstractRepository
{
	/** @var Article $model Model物件 */
	protected $model;
	/**
	 * ArticleRepository constructor.
	 * @param $model
	 */
	public function __construct(Article $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	public function createArticle(array $data, int $user_id)
	{
		$article = new Article();
		$article->category_id = $data['category_id'];
		$article->user_id = $user_id;
		$article->title = $data['title'];
		$article->slug = $data['slug'];
		$article->body = $data['body'];
		$article->save();
		if (isset($data['tags'])) {
			$article->tags()->sync($data['tags']);
		} else {
			$article->tags()->sync(array());
		}
		return $article;
	}

	public function updateArticle(array $data, int $id)
	{
		$article = $this->model->find($id);
		$article->category_id = $data['category_id'];
		$article->title = $data['title'];
		$article->slug = $data['slug'];
		$article->body = $data['body'];
		$article->save();
		if (isset($data['tags'])) {
			$article->tags()->sync($data['tags']);
		} else {
			$article->tags()->sync(array());
		}
		return $article;
	}

	public function deleteArticle(int $id)
	{
		$article = $this->model->find($id);
		$article->tags()->detach();
		return $article->delete();
	}

}