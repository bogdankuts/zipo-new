<?php namespace Mutators;

trait TrimmableTrait {
	public static function boot() {
		parent::boot();

		if (isset(static::$trimmed) and (!empty(static::$trimmed))) {
			$trimmed = static::$trimmed;

			static::saving(function($model) use ($trimmed){
				foreach ($model->attributes as $key => $value) {
					if (in_array($key, $trimmed)) {
						$model->{$key} = trim($value);
					}
				}
			});
		}
	}
}
