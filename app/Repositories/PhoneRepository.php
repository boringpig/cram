<?php


namespace App\Repositories;


use App\Models\Phone;

class PhoneRepository extends AbstractRepository
{
	/** @var Phone $model */
	protected $model;

	/**
	 * PhoneRepository constructor.
	 *
	 * @param Phone $model
	 */
	public function __construct(Phone $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	/**
	 * 建立學生電話
	 *
	 * @param array $data
	 * @param int $student_id
	 * @return Phone
	 */
	public function createPhone(array $data, int $student_id)
	{
		$phone = new Phone();
		$phone->student_id = $student_id;
		$phone->student_phone = $data['student_phone'];
		$phone->parent_phone = $data['parent_phone'];
		$phone->save();

		return $phone;
	}

	/**
	 * 更新學生電話
	 *
	 * @param array $data
	 * @param int $phone_id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function updatePhone(array $data, int $phone_id)
	{
		$phone = $this->model->find($phone_id);
		$phone->student_phone = $data['student_phone'];
		$phone->parent_phone = $data['parent_phone'];
		$phone->save();

		return $phone;

	}
}