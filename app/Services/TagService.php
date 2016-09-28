<?php


namespace App\Services;


use App\Repositories\TagRepository;

class TagService
{

	/**
	 * @var TagRepository
	 */
	private $tagRepository;

	/**
	 * TagService constructor.
	 *
	 * @param TagRepository $tagRepository
	 */
	public function __construct(TagRepository $tagRepository)
	{
		$this->tagRepository = $tagRepository;
	}

	/**
	 * 用陣列顯示全部的文章標籤
	 *
	 * @return array
	 */
	public function showAllTagByArray()
	{
		$tags = $this->tagRepository->all();
		$tag_list = [];
		foreach ($tags as $tag){
			$tag_list[$tag->id] = $tag->name;
		}

		return $tag_list;
	}

	/**
	 * 顯示全部的文章標籤
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
	public function showLatestTag()
	{
		return $this->tagRepository->getLatestTag();
	}

	/**
	 * 新增文章標籤
	 *
	 * @param array $data
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function addTag(array $data)
	{
		return $this->tagRepository->create($data);
	}

	/**
	 * 編輯文章標籤
	 *
	 * @param array $data
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function editTag(array $data, int $id)
	{
		return $this->tagRepository->update($data, $id);
	}

	/**
	 * 刪除文章標籤
	 *
	 * @param int $id
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function deleteTag(int $id)
	{
		return $this->tagRepository->delete($id);
	}
}