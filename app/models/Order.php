<?php
/**
 * Created by PhpStorm.
 * User: BogdanKootz
 * Date: 30.04.16
 * Time: 17:01
 */

class Order extends BaseModel {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'order_id';

	public static function getRecentOrders() {
		$orders = new Order;
		$orders = $orders
			->join('clients', 'clients.client_id', '=', 'orders.client_id')
			->join('states', 'states.state_id' , '=', 'orders.state');
		return $orders
			->where('deleted', '!=', 1)
			->where('state', '!=', '3')
			->orderBy('date', 'asc')->take(10)->get();
	}

	public static function getRecentDoneOrders() {
		$orders = new Order;
		$orders = $orders->join('clients', 'clients.client_id', '=', 'orders.client_id')->join('states', 'states.state_id' , '=', 'orders.state');
		return $orders
			->where('deleted', '!=', 1)
			->where('state', '=', '3')
			->orderBy('date', 'asc')->take(10)->get();
	}

	private function getFullOrderItems($order) {
		$itemsInOrder = json_decode($order['items']);
		$fullItems = [];
		foreach ($itemsInOrder as $item) {
			$quantity = $item->count;
			$price = $item->price;
			$item = Item::find($item->id);
			$item['price'] = $price;
			$item['count'] = $quantity;
			$item['currency'] = 'РУБ';
			$fullItems[] = $item;
		}

		return $fullItems;
	}

	private function getOrderSum($order) {
		$orderSum = 0;

		foreach($order->items as $item) {
			$price = $item->price;
			$quantity = $item->count;
			$sum = $price * $quantity;
			$orderSum +=$sum;
		}

		return $orderSum;
	}

	private function normalizeDelivery($order) {
		switch($order->delivery) {
			case 'self':
				$order->delivery = 'Самовывоз';
				break;
			case 'St.Petersburg_delivery':
				$order->delivery = 'Доставка По Санкт Петербургу';
				break;
			case 'TK_business_lines':
				$order->delivery = 'Доставка до терминала ТК Деловые Линии в Санкт Петербурге';
				break;
			case 'EMC':
				$order->delivery = 'Доставка EMC до адреса получателя.';
				break;
			case 'SDEK':
				$order->delivery = 'Доставка экспресс почтой СДЭК до адреса получателя.';
				break;
			case 'RATEK':
				$order->delivery = 'Доставка до терминала ТК РАТЭК в Санкт Петербурге.';
				break;
			case 'PONY':
				$order->delivery = 'Доставка экспресс почтой Pony express  до адреса получателя.';
				break;
			case 'Dimex':
				$order->delivery = 'Доставка экспресс почтой  dimex до адреса получателя.';
				break;
		}

	}

	private function normalizeFormOfBusiness($order) {
		switch($order->form_of_business) {
			case 'jura':
				$order->form_of_business = ' Юридические лица';
				break;
			case 'physic':
				$order->form_of_business = ' Физические лица';
				break;
		}
	}

	public function getAllOrders() {
		$orders = new Order;
		$orders = $orders
			->join('clients', 'clients.client_id', '=', 'orders.client_id')
			->join('states', 'states.state_id' , '=', 'orders.state')
			->where('deleted', '!=', 1)
			->orderBy('state', 'asc')
			->orderBy('order_id', 'desc')
			->get();

		foreach ($orders as $order) {
			$order['items'] = $this->getFullOrderItems($order);
			$order['sum'] = $this->getOrderSum($order);
			$this->normalizeDelivery($order);
			$this->normalizeFormOfBusiness($order);
		}

		return $orders;
	}

	public function getAllOrdersByClient($client_id) {
		$orders = new Order;
		$orders = $orders
			->join('clients', 'clients.client_id', '=', 'orders.client_id')
			->join('states', 'states.state_id' , '=', 'orders.state')
			->where('orders.client_id', '=', $client_id)
			->orderBy('state', 'asc')
			->orderBy('order_id', 'desc')
			->get();

		foreach ($orders as $order) {
			$order['items'] = $this->getFullOrderItems($order);
			$order['sum'] = $this->getOrderSum($order);
			$this->normalizeDelivery($order);
		}

		return $orders;
	}


	private function getNumberOfOrder($client_id) {
		$ordersQuantity =  Order::where('client_id', '=', $client_id)->count();

		return $ordersQuantity;
	}

	public function getDetailedOrder($order_id) {
		$orders = new Order;
		$orders = $orders->join('clients', 'clients.client_id', '=', 'orders.client_id')->join('states', 'states.state_id' , '=', 'orders.state')->get();
		$order = $orders->find($order_id);

		$order['items'] = $this->getFullOrderItems($order);
		$order['sum'] = $this->getOrderSum($order);
		$order['number_of_order'] = $this->getNumberOfOrder($order->client_id);
		$this->normalizeDelivery($order);
		$this->normalizeFormOfBusiness($order);

		return $order;
	}

//	public static function  getNewAdminOrders($last_visit) {
//		$orders = new Order;
//		$orders = $orders->join('clients', 'clients.client_id', '=', 'orders.client_id')->whereBetween('added_at', array($last_visit, date('Y-m-d')))->get();
//
//		return $orders;
//	}
}