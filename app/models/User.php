<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'user_id';


	private function countOrderByClientSum($client_id) {
		$ordersByClient = new Order();
		$ordersByClient = $ordersByClient->getAllOrdersByClient($client_id);

		$ordersByClientSum = 0;

		foreach($ordersByClient as $order) {
			$ordersByClientSum += $order->sum;
		}

		return $ordersByClientSum;
	}

	public function getAllUsers() {
		$users = User::all();

		foreach($users as $user) {
			$client = Client::where('registered', '=', $user->user_id)->get();
			if ($client->first()) {
				$clientOrder = new Client;
				$clientOrders = $clientOrder->countOrderByClient($client->first()->client_id);
				$clientOrdersSum = $clientOrder->countOrderByClientSum($client->first()->client_id);
				$user->total_orders = $clientOrders;
				$user->total_orders_sum = $clientOrdersSum;
			} else {
				$user->total_orders = 0;
				$user->total_orders_sum = 0;
			}
		}

		return $users;
	}

	public function getDetailedUser($user_id) {
		$user = User::find($user_id);
		$Client = new Client();
		$client = Client::where('registered', '=', $user->user_id)->get();
		if ($client->first()) {
			$user->total_orders = $Client->countOrderByClient($client->first()->client_id);
			$user->total_orders_sum = $Client->countOrderByClientSum($client->first()->client_id);
		}



		return $user;
	}
}