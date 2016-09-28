<?php


namespace App\Services;


use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use Auth;

class ArticleService
{

	/**
	 * @var ArticleRepository
	 */
	private $articleRepository;
	/**
	 * @var CategoryRepository
	 */
	private $categoryRepository;

	/**
	 * ArticleService constructor.
	 *
	 * @param ArticleRepository $articleRepository
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(ArticleRepository $articleRepository, CategoryRepository $categoryRepository)
	{
		$this->articleRepository = $articleRepository;
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * 顯示全部的文章
	 *
	 * @return \Illuminate\Database\Eloquent\Collection
	 */
	public function showAllArticle()
	{
		return $this->articleRepository->paginate(8);
	}

	/**
	 * 顯示特定的文章
	 *
	 * @param string $slug
	 * @return mixed
	 */
	public function showArticleBySlug(string $slug)
	{
		return $this->articleRepository->getArticleBySlug($slug);
	}

	/**
	 * 新增文章
	 *
	 * @param array $data
	 * @return \App\Models\Article
	 */
	public function addArticle(array $data)
	{
		$user_id = Auth::user()->id;

		return $this->articleRepository->createArticle($data, $user_id);
	}

	/**
	 * 編輯文章
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function editArticle(array $data, int $id)
	{
		return $this->articleRepository->updateArticle($data, $id);
	}

	/**
	 * 刪除文章
	 *
	 * @param int $id
	 * @return bool|null
	 */
	public function deleteArticle(int $id)
	{
		return $this->articleRepository->deleteArticle($id);
	}

}