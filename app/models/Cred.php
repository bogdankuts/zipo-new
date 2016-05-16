<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Cred extends BaseModel implements UserInterface, RemindableInterface{
	use UserTrait, RemindableTrait;
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'cred_id';

//	public function isMaster($user) {
//
//	}

//	public static function getDiscount() {
//		$cred = new Cred;
//		$discount = $cred->first(['discount'])->discount;
//		return $discount;
//	}
//
//	public static function setDiscount() {
//		$discount = Input::get('discount');
//
//		$cred = Cred::find(1);
//		$cred->discount = $discount;
//		$cred->save();
//	}
}