<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	protected $data;

	protected $types = ['array', 'string'];

	protected function assertType($attribute, $type) {
		$this->assertViewHas($attribute);
		if (in_array($type, $this->types)) {
			$this->assertInternalType($type, $this->data[$attribute]);
		} else {
			$this->assertInstanceOf($type, $this->data[$attribute]);
		}
	}

	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

}
