<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Setting extends BaseModel implements UserInterface, RemindableInterface{
	use UserTrait, RemindableTrait;
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'setting_id';

	public static function getDiscount() {
		$discount = Setting::find(1)->value;
		return $discount;
	}

	public static function setDiscount() {
		$discount = Input::get('discount');
		$setting = Setting::find(1);
		$setting->value = $discount;
		$setting->save();
	}

	public static function getFullDiscount() {
		$discount = new Cred;
		$discount = $discount->join('settings', 'creds.cred_id', '=', 'settings.changed_by')->find(1);

		return $discount;
	}
}