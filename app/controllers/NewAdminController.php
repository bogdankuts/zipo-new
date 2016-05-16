<?php
/**
 * Created by PhpStorm.
 * User: BogdanKootz
 * Date: 04.05.16
 * Time: 11:14
 */
class NewAdminController extends BaseController {

	private function definePageTitle() {
		$route = Route::currentRouteName();
		if ( $route == 'dashboard') {
			return $title = 'Dashboard';
		} elseif ($route == 'new_admins_after') {
			return $title = 'Новые админы';
		} elseif ($route == 'new_clients_after') {
			return $title = 'Новые Клиенты';
		} elseif ($route == 'new_orders_after') {
			return $title = 'Новые Заказы';
		} elseif ($route == 'new_users_after') {
			return $title = 'Новые Клиенты';
		} elseif ($route == 'new_articles_after') {
			return $title = 'Новые Статьи';
		} elseif ($route == 'catalog_admin' || $route == 'items_admin') {
			return $title = 'Каталог';
		}
	}

	private function countIncorrectEnteties($entity) {
		$noMetaEnteties = DB::table($entity)
				->where('meta_title', '=', '')
				->orWhere('meta_description', '=', '')
				->count();

		return $noMetaEnteties;
	}

	private function countNoTitleEnteties($entity) {
		$noTitleEntety = DB::table($entity)
				->where('meta_title', '=', '')
				->count();
		return $noTitleEntety;
	}

	private function countNoDescriptionEnteties($entity) {
		$noDescriptionEntety = DB::table($entity)
				->where('meta_description', '=', '')
				->count();
		return $noDescriptionEntety;
	}

	private function getMostViewedItems() {
		$mostViewedItems = Item::getMostViewedItems();

		return $mostViewedItems;
	}

	private function getMostSellingItems() {
		//TODO::Refactor this part(get rid of loop inside loop and check the logic one more time);

		$orders = Order::all();
		$ids = [];
		$result = [];
		foreach ($orders as $order) {
			$items = json_decode($order->items);
			foreach ($items as $item) {
				if (array_key_exists($item->id, $ids)) {
					$ids[$item->id] = $ids[$item->id] + $item->count;
				} else {
					$ids[$item->id] = $item->count;
				}
			}
		}
		arsort($ids);
		$count = count($ids);
		if ($count > 10) {
			$ids = array_slice($ids, 0, 10, TRUE);
		}
		foreach ($ids as $id => $sales) {
			$item = Item::find($id);
			$item->sales = $sales;
			$result[] = $item;
		}

		return $result;
	}

	private function getRecentOrders() {
		$results = Order::getRecentOrders();
		foreach ($results as $result) {
			$result->date = date('d-m-Y', strtotime($result->date));
		}

		return $results;
	}
	private function getRecentDoneOrders() {
		$results = Order::getRecentDoneOrders();
		foreach ($results as $result) {
			$result->date = date('d-m-Y', strtotime($result->date));
		}

		return $results;
	}

	private function updateLastAdminVisit() {
		$cred = Cred::find(Auth::admin()->get()->cred_id);
		$cred->last_visit = date('Y-m-d', time());
		$cred->save();
	}

	private function getNotifications($last_visit) {
		$notifications = [];
		$notifications['newAdmins'] = count($this->getNewAdmins($last_visit));
		$notifications['newDiscount'] = $this->getNewDiscount($last_visit);
		$notifications['newArticles'] = count($this->getNewArticles($last_visit));
		$notifications['newOrders'] = count($this->getNewOrders($last_visit));
		$notifications['newClients'] = count($this->getNewClients($last_visit));
		$notifications['newUsers'] = count($this->getNewUsers($last_visit));

		return $notifications;

	}

	private function getNewOrders($last_visit) {
		$orders = Order::whereBetween('date', array($last_visit, date('Y-m-d')))->get();

		return $orders;
	}

	private function getNewClients($last_visit) {
		$newClients = new Client;
		$newClients = $newClients->whereBetween('added_at', array($last_visit, date('Y-m-d')))->get();

		return $newClients;
	}

	private function getNewUsers($last_visit) {
		$newUsers = new User;
		$newUsers = $newUsers->whereBetween('timestamp', array($last_visit, date('Y-m-d')))->get();

		return $newUsers;
	}

	private function getNewAdmins($last_visit) {
		$newAdmins = new Cred;
		$newAdmins = $newAdmins->whereBetween('added_at', array($last_visit, date('Y-m-d')))->get();

		return $newAdmins;
	}

	private function getNewDiscount($last_visit) {
		$discount = Setting::getFullDiscount();
		$discount_changed_date = strtotime($discount->changed_at);
		$last_visit = strtotime($last_visit);

		if ($discount_changed_date > $last_visit) {
			return "Дисконт был изменен $discount->login и теперь составляет $discount->value%";
		} else {
			return false;
		}
	}

	private function getNewArticles($last_visit) {
		$articles = Article::whereBetween('time', array($last_visit, date('Y-m-d')))->get();

		return $articles;
	}

	public function admin() {
		if (Auth::admin()->check()) {
			$last_visit = Auth::admin()->get()->last_visit;

			$this->getNotifications($last_visit);

//			$this->updateLastAdminVisit();

			return View::make('new_admin/dashboard')->with([
					'env' 				            => 'dashboard',
					'pageTitle'                     => $this->definePageTitle(),
					'allItems'                      => Item::all()->count(),
					'noMetaItems'                   => $this->countIncorrectEnteties('items'),
					'noTitleItems'                  => $this->countNoTitleEnteties('items'),
					'noDescriptionItems'            => $this->countNoDescriptionEnteties('items'),
					'noMetaArticles'                => $this->countIncorrectEnteties('articles'),
					'noTitleArticles'               => $this->countNoTitleEnteties('articles'),
					'noDescriptionArticles'         => $this->countNoDescriptionEnteties('articles'),
					'allArticles'                   => Article::all()->count(),
					'mostViewedItems'               => $this->getMostViewedItems(),
					'mostSellingItems'              => $this->getMostSellingItems(),
					'recentOrders'                  => $this->getRecentOrders(),
					'recentDoneOrders'              => $this->getRecentDoneOrders(),
					'notifications'                 => $this->getNotifications($last_visit),
					'lastVisit'                     => $last_visit

			]);
		} else {
			return View::make('new_admin/login');
		}
	}

	public function newAdminsAfterVisit($last_visit) {
		return View::make('new_admin/new_admins_list')->with([
				'env'       => 'new_admins_after_last_visit',
				'pageTitle' => $this->definePageTitle(),
				'newAdmins' => $this->getNewAdmins($last_visit),
		]);
	}

	public function newClientsAfterVisit($last_visit) {
		return View::make('new_admin/new_clients_list')->with([
				'env'       	=> 'new_clients_after_last_visit',
				'pageTitle' 	=> $this->definePageTitle(),
				'newClients' 	=> $this->getNewClients($last_visit),
		]);
	}

	public function newOrdersAfterVisit($last_visit) {
		return View::make('new_admin/new_orders_list')->with([
				'env'       => 'new_orders_after_last_visit',
				'pageTitle' => $this->definePageTitle(),
				'newOrders' => $this->getNewOrders($last_visit),
		]);
	}

	public function newUsersAfterVisit($last_visit) {
		return View::make('new_admin/new_users_list')->with([
				'env'       => 'new_users_after_last_visit',
				'pageTitle' => $this->definePageTitle(),
				'newUsers' 	=> $this->getNewUsers($last_visit),
		]);
	}

	public function newArticlesAfterVisit($last_visit) {
		return View::make('new_admin/new_articles_list')->with([
				'env'           => 'new_articles_after_last_visit',
				'pageTitle'     => $this->definePageTitle(),
				'newArticles' 	=> $this->getNewArticles($last_visit),
		]);
	}

	public function catalog() {
		return View::make('new_admin/catalog')->with([
			'env' 		=> 'catalog_admin',
			'pageTitle' => $this->definePageTitle(),
			'subcats'   => Subcat::readAllSubcats(),
			'producers' => Producer::readAllProducers(),
		]);
	}

	public function items() {
		return View::make('new_admin/items')->with([
			'pdfs'		=> Pdf::all(),
			'current'	=> Subcat::find(Input::get('subcat_id')),
			'env' 		=> 'catalog_admin',
			'pageTitle' => $this->definePageTitle(),
			'items'     => Item::getItemsForAdminCatalog()
		]);
	}

	public function markOrderAsDone($id) {
		$order = Order::find($id);
		$order->state = 3;
		$order->save();
	}

	public function toggleItemHit($item_id) {
		$item = Item::find($item_id);
		if ($item->hit === 1) {
			$item->hit = 0;
		} else {
			$item->hit = 1;
		}
		$item->save();
	}



}