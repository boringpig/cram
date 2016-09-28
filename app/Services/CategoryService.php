<?php


namespace App\Services;


use App\Repositories\CategoryRepository;

class CategoryService
{

	/**
	 * @var CategoryRepository
	 */
	private $categoryRepository;

	/**
	 * CategoryService constructor.
	 *
	 * @param CategoryRepository $categoryRepository
	 */
	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * 用陣列顯示全部的文章分類
	 *
	 * @return array
	 */
	public function showAllCategoryByArray()
	{
		// 等於$this->categoryRepository->lists('name', 'id');
		$categories = $this->categoryRepository->all();
		$cat = [];
		foreach ($categories as $category){
			$cat[$category->id] = $category->name;
		}

		return $cat;
	}

	/**
	 * 顯示全部的文章分類
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function showLatestCategory()
	{
		return $this->categoryRepository->getLatestCategory();
	}

	/**
	 * 新增文章分類
	 *
	 * @param array $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function addCategory(array $data)
	{
		return $this->categoryRepository->create($data);
	}

	/**
	 * 編輯文章分類
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function editCategory(array $data, int $id)
	{
		return $this->categoryRepository->update($data, $id);
	}

	/**
	 * 刪除文章分類
	 *
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deleteCategory(int $id)
	{
		return $this->categoryRepository->delete($id);
	}
}