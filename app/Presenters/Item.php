<?php namespace Presenters;

use Presenters\Presenter;

class Item extends Presenter {	
	public function price() {
		$rate = get_EUR_rate();
		if ('EUR' == $this->val('currency')) {
			return round($this->val()*$rate);
		} else {
			return round($this->val());
		}
	}

	public function currency() {
		return 'РУБ';
		// if ('EUR' == $this->val()) {
		// 	return 'РУБ';
		// } else {
		// 	return $this->val();
		// }
	}
}