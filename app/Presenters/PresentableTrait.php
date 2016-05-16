<?php namespace Presenters;

trait PresentableTrait {
	public function __get($key) {
		if (empty($this->presenter)) {
			return $this->getAttribute($key);
		}

		if ( ! $this->presenter or ! class_exists($this->presenter)) {
			throw new Exception("Please set the $protected key to your presenter path.");
		}

		if (method_exists($this->presenter, $key)) {
			$presenterInstance = new $this->presenter($this);
			return $presenterInstance->{$key}();
		} 

		return $this->getAttribute($key);
	}
}

// // singleton pattern
// protected static $presenterInstance;

// if (! isset(static::$presenterInstance)) {
// 	static::$presenterInstance = new $this->presenter($this); // $this->presenter($this) === Presenters\Item($this)
// }

// return static::$presenterInstance;