<?php

namespace App\Repositories;

use App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
	/** 注入的model */
	protected $model;
	/** @var string $modelName model名稱 */
	protected $modelName;

	/**
	 * AbstractRepository constructor.
	 */
	public function __construct()
	{
		$this->modelName = get_class($this->model);
	}

	/**
	 * 根據pk找資料
	 * @param $id
	 * @param array $columns
	 * @return mixed
	 */
	public function find($id, $columns = ['*'])
	{
		return $this->model->find($id, $columns);
	}

	/**
	 * 根據一般欄位找資料
	 * @param $attribute
	 * @param $value
	 * @param array $columns
	 * @return Model
	 */
	public function findBy($attribute, $value, $columns = ['*'])
	{
		return $this->model
			->where($attribute, '=', $value)
			->first($columns);
	}

	/**
	 * 若存在則傳回 model，若不存在則新增
	 * @param array $data
	 * @return Model
	 */
	public function firstOrCreate(array $data)
	{
		return $this->model->firstOrCreate($data);
	}

	/**
	 * 回傳全部資料
	 * @param array $columns
	 * @return Collection
	 */
	public function all($columns = ['*'])
	{
		return $this->model->all($columns);
	}

	/**
	 * 回傳分頁資料
	 * @param int $perPage
	 * @param array $columns
	 * @return Collection
	 */
	public function paginate($perPage = 15, $columns = ['*'])
	{
		return $this->model->paginate($perPage, $columns);
	}

	/**
	 * 新增資料，傳回 model，不存檔
	 * @param array $data
	 * @return Model
	 */
	public function new(array $data)
	{
		return new $this->modelName($data);
	}

	/**
	 * 新增資料，回傳 model，直接存檔
	 * @param array $data
	 * @return Model
	 */
	public function create(array $data)
	{
		return $this->model->create($data);
	}

	/**
	 * 修改資料，回傳 model，直接存檔
	 * @param array $data
	 * @param $id
	 * @param string $attribute
	 * @return Model
	 */
	public function update(array $data, $id, $attribute = "id")
	{
		return $this->model
			->where($attribute, '=', $id)
			->update($data);
	}

	/**
	 * 刪除資料，回傳 model，直接刪除
	 * @param $id
	 * @return Model
	 */
	public function delete($id)
	{
		return $this->model->destroy($id);
	}
}