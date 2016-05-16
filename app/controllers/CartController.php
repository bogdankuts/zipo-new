<?php
/**
 * Created by PhpStorm.
 * User: BogdanKootz
 * Date: 08.04.16
 * Time: 10:33
 */
class CartController extends BaseController {
	public function cart() {
		return View::make('cart')->with([
				'articles'	=> Article::readAllArticles(),
				'recents'	=> Recent::readAllRecents(),
				'producers' => Producer::readAllProducers(),
				'subcats'   => Subcat::readAllSubcats(),
				'env' 		=> 'cart',
				'cart_items'=> $this->getCartItems()
		]);
	}

	public function order_page() {
		return View::make('order')->with([
				'items'		=> $this->getCartItems(),
				'articles'	=> Article::readAllArticles(),
				'recents'	=> Recent::readAllRecents(),
				'producers' => Producer::readAllProducers(),
		]);
	}

	public function order() {
		$data = Input::all();
		$orderItems = $_COOKIE['shopcartItems'];
		$email = $data['email'];
		$file = $data['requisites'];

		$this->dataIsValid($email);

		if ($file) {
			$filepath = $this->loadRequisitesToServer($data);
		} else {
			$filepath = '';
		}

		$clientId = $this->addClientToDB($data);
		$orderId = $this->addOrderToDB($data, $clientId, $orderItems, $filepath);

		$this->sendEmails($data, $orderId, $filepath);

		$this->clearCart();

		return Redirect::to('/')->with('message', 'Ваш заказ оформлен!');
	}

	private function clearCart() {
		$cart = $_COOKIE['shopcartItems'];
		setcookie("shopcartItems", "shopcartItems", time()-1);
	}

	private function loadRequisitesToServer($data) {
		$file = $data['requisites'];
		$name = $data['name'];
		$surname = $data['surname'];

		$destinationPath = public_path().DIRECTORY_SEPARATOR.'requisites';
		$filename_old = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();
		$filename = $name.'_'.$surname.'('.date('d.m.Y H:i:s').')'.'.'.$extension;
		$file->move($destinationPath, $filename);
		$filepath = $destinationPath.'/'.$filename;

		return $filepath;
	}

	private function dataIsValid($email) {
		if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return Redirect::back()->withErrors('Поле email должно содержать email адрес!');
		}
		return true;
	}

	private function addClientToDB($data) {
		$clientData = [];
		$clientData['name'] = $data['name'];
		$clientData['surname'] = $data['surname'];
		$clientData['email'] = $data['email'];
		$clientData['phone'] = $data['phone'];
		$clientData['company'] = $data['company'];
		$clientData['form_of_business'] = $data['form'];
		$clientData['added_at'] = date('Y-m-d', time());

		$match = [];
		foreach ($clientData as $key=>$value) {
			$match[$key] = $value;
		}

		$oldClient = new Client;
		$oldClient = $oldClient->getOldClient($match);

		if (empty($oldClient->client_id)) {
			$client = Client::create($clientData);
			return $client->client_id;
		} else {
			return $oldClient->client_id;
		}
	}

	private function addOrderToDB($data, $client_id, $items, $requisites) {
		$orderData = [];
		$orderData['date'] = date('Y-m-d', time());
		$orderData['client_id'] = $client_id;
		$orderData['items'] = $items;
		$orderData['requisites'] = $requisites;
		$orderData['delivery'] = $data['delivery'];
		$orderData['address'] = $data['address'];
		$orderData['comment'] = $data['comment'];
		$orderData['state'] = 1;

		$order = Order::create($orderData);

		return $order->order_id;
	}

	private function formOrderItemsArray($orderId) {
		$itemsDB = Order::find($orderId)->items;
		$items = json_decode($itemsDB);
		foreach ($items as $item) {
			$item->title = Item::find($item->id)->title;
		}

		return $items;
	}

	private function sendEmails($data, $orderId, $filepath) {
		$this->sendToAdmin($data, $orderId, $filepath);
		$this->sendToUser($data, $orderId);
	}

	private function sendToAdmin($data, $orderId, $filepath) {
		$data['items'] = $this->formOrderItemsArray($orderId);
		$data['orderId'] = $orderId;
		if ($data['requisites']) {
			Mail::send('emails.email_order', $data, function ($mail) use ($data, $filepath) {
				$mail->to('vsezip@gmail.com', $data['name'])->subject('Заказ оформлен - vsezip.ru');
				$mail->attach($filepath);
			});
		}else {
			Mail::send('emails.email_order', $data, function ($mail) use ($data) {
				$mail->to('vsezip@gmail.com', $data['name'])->subject('Заказ оформлен - vsezip.ru');
			});
		}
	}

	private function sendToUser($data, $orderId) {
		$data['items'] = $this->formOrderItemsArray($orderId);
		$data['orderId'] = $orderId;
		Mail::send('emails.email_order_user', $data, function ($mail) use ($data) {
			$mail->to($data['email'], $data['name'])->subject('Заказ оформлен - vsezip.ru');
		});
	}

	private function getStoredCart() {
		$cartCookie = $_COOKIE['shopcartItems'];
		$cartItems = json_decode($cartCookie);
		return $cartItems;
	}

	private function getCartItems() {
		$cartItems = $this->getStoredCart();
		foreach ($cartItems as $cartItem) {
			$cartItemName = Item::find($cartItem->id)->title;
			$cartItem->title = $cartItemName;
			$cartItemPriceInitial = Item::find($cartItem->id)->price;
			if (Auth::user()->check()) {
				$cartItemPrice = HELP::discount_price($cartItemPriceInitial);
			} else {
				$cartItemPrice = $cartItemPriceInitial;
			}
			if ($cartItem->price !== $cartItemPrice) {
				$cartItem->price = $cartItemPrice;
			}
		}
		return $cartItems;
	}


}