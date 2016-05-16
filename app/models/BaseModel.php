<?php

use Presenters\PresentableTrait;
use Mutators\TrimmableTrait;
use Mutators\FlattenableTrait;

class BaseModel extends Eloquent {
	use FlattenableTrait;
	use PresentableTrait;
	use TrimmableTrait;
}