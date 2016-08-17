<?php


namespace App\Services;


use App\Repositories\ClockInRepository;

class ClockInService
{

	/**
	 * @var ClockInRepository
	 */
	private $clockInRepository;

	/**
	 * ClockInService constructor.
	 *
	 * @param ClockInRepository $clockInRepository
	 */
	public function __construct(ClockInRepository $clockInRepository)
	{
		$this->clockInRepository = $clockInRepository;
	}


}