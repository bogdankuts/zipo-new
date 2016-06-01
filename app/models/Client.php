<?php

class Client extends BaseModel {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'client_id';

	public function getOldClient($match) {
		$oldClient = Client::where($match)->first();
		return $oldClient;
	}

	public function countOrderByClient($client_id) {
		$ordersByClient = Order::where('client_id', '=', $client_id)
			->count();

		return $ordersByClient;
	}

	public function countOrderByClientSum($client_id) {
		$ordersByClient = new Order();
		$ordersByClient = $ordersByClient->getAllOrdersByClient($client_id);

		$ordersByClientSum = 0;

		foreach($ordersByClient as $order) {
			$ordersByClientSum += $order->sum;
		}

		return $ordersByClientSum;
	}

	private function checkIfClientIsRegistered($client) {
		//$clientData['name'] = $client->name;
		//$clientData['surname'] = $client->surname;
		//$clientData['phone'] = $client->phone;
		//$clientData['email'] = $client->email;
		//
		//$match = [];
		//foreach ($clientData as $key=>$value) {
		//	$match[$key] = $value;
		//}
		//
		//$registeredClient = User::where($match)->first();
		//
		//if ($registeredClient) {
		//	return 1;
		//} else {
		//	return 0;
		//}
		if($client->registered != 0) {
			return 1;
		} else {
			return 0;
		}
	}

	private function normalizeFormOfBusiness($client) {
		switch($client->form_of_business) {
			case 'jura':
				$client->form_of_business = ' Юридические лица';
				break;
			case 'physic':
				$client->form_of_business = ' Физические лица';
				break;
		}
	}

	public function getAllClients() {
		$clients = Client::all();
		foreach($clients as $client) {
			$client->total_orders = $this->countOrderByClient($client->client_id);
			$client->total_orders_sum = $this->countOrderByClientSum($client->client_id);
			$client->registered = $this->checkIfClientIsRegistered($client);
			$this->normalizeFormOfBusiness($client);
		}

		return $clients;
	}

	public function getDetailedClient($client_id) {
		$client = Client::find($client_id);

		$client->total_orders = $this->countOrderByClient($client_id);
		$client->total_orders_sum = $this->countOrderByClientSum($client_id);
		$client->registered = $this->checkIfClientIsRegistered($client);
		$this->normalizeFormOfBusiness($client);

		return $client;
	}

}