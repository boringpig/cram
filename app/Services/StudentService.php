<?php


namespace App\Services;


use App\Repositories\AddressRepository;
use App\Repositories\PhoneRepository;
use App\Repositories\StudentRepository;

class StudentService
{

	/**
	 * @var StudentRepository
	 */
	private $studentRepository;
	/**
	 * @var PhoneRepository
	 */
	private $phoneRepository;
	/**
	 * @var AddressRepository
	 */
	private $addressRepository;

	/**
	 * StudentService constructor.
	 *
	 * @param StudentRepository $studentRepository
	 * @param PhoneRepository $phoneRepository
	 * @param AddressRepository $addressRepository
	 */
	public function __construct(StudentRepository $studentRepository,
								PhoneRepository $phoneRepository,
								AddressRepository $addressRepository)
	{
		$this->studentRepository = $studentRepository;
		$this->phoneRepository = $phoneRepository;
		$this->addressRepository = $addressRepository;
	}

	public function showAllStudent()
	{
		return $this->studentRepository->paginate(8);
	}

	public function showStudentById(int $id)
	{
		return $this->studentRepository->find($id);
	}

	public function addStudent(array $data)
	{
		$student = $this->studentRepository->createStudent($data);
		$this->phoneRepository->createPhone($data, $student->id);
		$this->addressRepository->createAddress($data, $student->id);

		return $student;
	}

	public function editStudent(array $data, int $id)
	{
		$student = $this->studentRepository->updateStudent($data, $id);
		$this->phoneRepository->updatePhone($data, $student->phone->id);
		$this->addressRepository->updateAddress($data, $student->address->id);

		return $student;
	}

	public function deleteStudent(int $id)
	{
		return $this->studentRepository->deleteStudent($id);
	}
}