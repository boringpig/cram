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

	public function createAddress(array $data, int $student_id)
	{
		$address = new Address();
		$address->student_id = $student_id;
		$address->home_address = $data['county']. $data['district'] .$data['home_address'];
		$address->save();

		return $address;
	}

	public function updateAddress(array $data, int $address_id)
	{
		$address = $this->model->find($address_id);
		$address->home_address = $data['county']. $data['district'] .$data['home_address'];
		$address->save();

		return $address;
	}
}