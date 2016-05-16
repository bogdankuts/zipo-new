<?php namespace Presenters;

abstract class Presenter {
	protected $entity;

	function __construct($entity) {
		$this->entity = $entity;
	}

	protected function val($key=null) {
		if (empty($key)) {
			$callers = debug_backtrace();
			$calling_function_name = $callers[1]['function'];
			return $this->entity->getAttribute($calling_function_name);
		} else {
			return $this->entity->getAttribute($key);
		}
	}
}