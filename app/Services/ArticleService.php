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

	public function addArticle(array $data)
	{
		$user_id = Auth::user()->id;

		return $this->articleRepository->createArticle($data, $user_id);
	}

	public function showAllArticle()
	{
		return $this->articleRepository->paginate(8);
	}

	public function showArticleById(int $id)
	{
		return $this->articleRepository->find($id);
	}

	public function editArticle(array $data, int $id)
	{
		return $this->articleRepository->updateArticle($data, $id);
	}

	public function deleteArticle(int $id)
	{
		return $this->articleRepository->deleteArticle($id);
	}

}