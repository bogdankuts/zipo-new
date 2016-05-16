<?php

class Client extends BaseModel {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'client_id';

	public function getOldClient($match) {
		$oldClient = Client::where($match)->first();
		return $oldClient;
	}

}