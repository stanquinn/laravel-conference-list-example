<?php
//require_once 'PHPUnit/Autoload.php';

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase { //PHPUnit_Framework_TestCase

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

}
