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

	public function showLatestCategory()
	{
		return $this->categoryRepository->getLatestCategory();
	}

	public function addCategory(array $data)
	{
		return $this->categoryRepository->create($data);
	}

	public function editCategory(array $data, int $id)
	{
		return $this->categoryRepository->update($data, $id);
	}

	public function deleteCategory(int $id)
	{
		return $this->categoryRepository->delete($id);
	}
}