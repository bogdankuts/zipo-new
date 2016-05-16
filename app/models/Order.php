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
		$orders = $orders->join('clients', 'clients.client_id', '=', 'orders.client_id')->join('states', 'states.id' , '=', 'orders.state');
		return $orders->where('state', '!=', '3') ->orderBy('date', 'asc')->take(10)->get();
	}

	public static function getRecentDoneOrders() {
		$orders = new Order;
		$orders = $orders->join('clients', 'clients.client_id', '=', 'orders.client_id')->join('states', 'states.id' , '=', 'orders.state');
		return $orders->where('state', '=', '3')->orderBy('date', 'asc')->take(10)->get();
	}

//	public static function  getNewAdminOrders($last_visit) {
//		$orders = new Order;
//		$orders = $orders->join('clients', 'clients.client_id', '=', 'orders.client_id')->whereBetween('added_at', array($last_visit, date('Y-m-d')))->get();
//
//		return $orders;
//	}
}