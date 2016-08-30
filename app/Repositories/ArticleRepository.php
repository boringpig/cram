<?php


namespace App\Repositories;

use App\Models\Article;
use Intervention\Image\Facades\Image;
use Mews\Purifier\Facades\Purifier;
use Storage;

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
		//儲存文章的圖片
		$file = $data['article_image'];
		$fileName = time(). '.jpg';
		$image = (string) Image::make($file)->encode('jpg', 75)->resize(900, 300);
		$filePath = 'articles/' . $fileName;
		$s3 = Storage::cloud();
		$s3->put($filePath, $image, 'public');

		$article = new Article();
		$article->category_id = $data['category_id'];
		$article->user_id = $user_id;
		$article->title = $data['title'];
		$article->slug = $data['slug'];
		$article->image = $filePath;
		$article->body = Purifier::clean($data['body']);
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
		if (isset($data['article_image'])){
			//儲存文章的圖片
			$file = $data['article_image'];
			$fileName = time(). '.jpg';
			$image = (string) Image::make($file)->encode('jpg', 75)->resize(900, 300);
			$filePath = 'articles/' . $fileName;
			$s3 = Storage::cloud();
			$s3->delete($article->image);
			$s3->put($filePath, $image, 'public');
			$article->image = $filePath;
		}

		$article->category_id = $data['category_id'];
		$article->title = $data['title'];
		$article->slug = $data['slug'];
		$article->body = Purifier::clean($data['body']);
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
		$s3 = Storage::cloud();
		$s3->delete($article->image);
		$article->tags()->detach();

		return $article->delete();
	}

}