<?php

namespace App\Traits;

trait Log
{
	private function logRegisterUser(string $name, string $description, array $property)
	{
		activity($name)
			->withProperties($property)
			->log($description);
	}

	private function logUserAuth(string $name, string $description, array $property)
	{
		activity($name)
			->withProperties($property)
			->log($description);
	}

	private function logUserAccount(string $name, string $description, array $property)
	{
		activity($name)
			->withProperties($property)
			->log($description);
	}

}