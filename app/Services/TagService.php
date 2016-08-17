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

	public function showAllTagByArray()
	{
		$tags = $this->tagRepository->all();
		$tag_list = [];
		foreach ($tags as $tag){
			$tag_list[$tag->id] = $tag->name;
		}

		return $tag_list;
	}

	public function showLatestTag()
	{
		return $this->tagRepository->getLatestTag();
	}

	public function addTag(array $data)
	{
		return $this->tagRepository->create($data);
	}

	public function editTag(array $data, int $id)
	{
		return $this->tagRepository->update($data, $id);
	}

	public function deleteTag(int $id)
	{
		return $this->tagRepository->delete($id);
	}
}