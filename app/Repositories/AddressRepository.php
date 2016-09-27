<?php


namespace App\Repositories;


use App\Models\Address;

class AddressRepository extends AbstractRepository
{
	/** @var Address $model */
	protected $model;

	/**
	 * AddressRepository constructor.
	 *
	 * @param Address $model
	 */
	public function __construct(Address $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	/**
	 * 建立學生地址
	 *
	 * @param array $data
	 * @param int $student_id
	 * @return Address
	 */
	public function createAddress(array $data, int $student_id)
	{
		$address = new Address();
		$address->student_id = $student_id;
		$address->home_address = $data['county']. $data['district'] .$data['home_address'];
		$address->save();

		return $address;
	}

	/**
	 * 更新學生地址
	 *
	 * @param array $data
	 * @param int $address_id
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
	 */
	public function updateAddress(array $data, int $address_id)
	{
		$address = $this->model->find($address_id);
		$address->home_address = $data['county']. $data['district'] .$data['home_address'];
		$address->save();

		return $address;
	}
}