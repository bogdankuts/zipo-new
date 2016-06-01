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
		$title = '';

		switch($route) {
			case 'dashboard':
				$title = 'Dashboard';
				break;
			case 'new_admins_after':
				$title = 'Новые админы';
				break;
			case 'new_clients_after':
				$title = 'Новые Клиенты';
				break;
			case 'new_orders_after':
				$title = 'Новые Заказы';
				break;
			case  'new_users_after':
				$title = 'Новые Клиенты';
				break;
			case 'new_articles_after':
				$title = 'Новые Статьи';
				break;
			case 'catalog_admin':
				$title = 'Каталог';
				break;
			case 'items_admin':
				$title = 'Каталог';
				break;
			case 'items_admin_change':
				$title = 'Добавление/Изменение товара';
				break;
			case 'articles_admin':
				$title = 'Статьи';
				break;
			case 'article_admin_change':
				$title = 'Добавление/Изменение статьи';
				break;
			case 'admin_producer':
				$title = 'Производители';
				break;
			case 'admin_producer_change':
				$title = 'Добавление/Изменение производителя';
				break;
			case 'admin_subcategories':
				$title = 'Подкатегории';
				break;
			case 'admin_orders':
				$title = 'Заказы';
				break;
			case 'admin_order':
				$title = 'Заказ';
				break;
			case 'admin_clients':
				$title = "Клиенты";
				break;
		}

		return $title;
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

//			$this->updateLastAdminVisit(); TODO:: uncomment this

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

	public function setSpecial() {
		$ids = Input::get('ids');

		Item::whereIn('item_id', $ids)->update(['special' => DB::raw('!special')]);

		return Response::json($ids);
	}

	public function setHit() {
		$ids = Input::get('ids');

		Item::whereIn('item_id', $ids)->update(['hit' => DB::raw('!hit')]);

		return Response::json($ids);
	}

	public function setProcurement() {
		$ids = Input::get('ids');

		Item::whereIn('item_id', $ids)->update(['procurement' => DB::raw('!procurement')]);

		return Response::json($ids);
	}

	public function deleteGroup() {
		$ids = Input::get('ids');

		Item::destroy($ids);

		return Response::json($ids);
	}

	public function changeSubcategory() {
		$ids = Input::get('ids');
		$fields = Input::all();
		unset($fields['ids']);

		Item::whereIn('item_id', $ids)->update($fields);

		return Response::json($ids);
	}

	public function getSubcategories() {
		$category = Input::get('category');
		$all = Subcat::readAllSubcats();
		$subcats = $all[$category];

		return Response::json($subcats);
	}

	public function ajaxDeleteItem() {
		$item = Item::find(Input::get('item_id'));

		if ($item->photo != 'no_photo.png') {
			$this->deletePhoto($item->photo);
		}
		$item->delete();

		return Redirect::back();
	}

	public function changeItem() {
		return View::make('new_admin/change_item')->with([
			'env' 		=> 'change_item',
			'item'		=> Item::__items()->find(Input::get('item_id')), // or use Model::findOrFail(1); if need to show delete button everywere
			'producers' => Producer::readAllProducers(),
			'pageTitle' => $this->definePageTitle(),
		]);
	}

	private function formFields() {
		$fields = Input::all();
		unset($fields['subcategoryActive']);

		if (!isset($fields['procurement'])) {
			$fields['procurement'] = 0;
		}
		if (!isset($fields['special'])) {
			$fields['special'] = 0;
		}
		if (!isset($fields['hit'])) {
			$fields['hit'] = 0;
		}

		return $fields;

	}

	private function formArticleFields() {
		$fields = Input::all();
		$today = date("Y-m-d", time());
		$fields['time'] = $today;

		return $fields;
	}

	private function convertPriceToEur($category, $price, $currency) {
		$categories = en_categories();
		if (in_array($category, $categories) and $currency  == 'РУБ') {
			$result['currency'] = 'EUR';
			$result['price'] = ceil($price/get_EUR_rate()*100)/100;
		}

		return $result;
	}

	//TODO:: refactor this function(works correctly, but looks bad)
	private function checkPhotoType($photo, $old) {
		if ($photo == 'no_photo.png') {
			if ($old == 'no_photo.png') {
				$type = 'no';
			} else {
				$type = 'deleted';
			}
		} else {
			if ($photo == $old) {
				$type = 'same';
			} else {
				if ($old != 'no_photo.png') {
					$type = 'new_deleted';
				} else {
					$type = 'new';
				}
			}
		}

		return $type;
	}

	private function deletePhoto($photo) {
		$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$photo;
		File::delete($filepath);

		return 'no_photo.png';
	}

	private function uploadPhoto($photo) {
		$temp = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$photo;
		$extension = File::extension($temp);
		$filename = 'photo_'.time().'.'.$extension;
		$new = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$filename;
		rename($temp, $new);

		return $filename;
	}

	private function processPhoto($photo, $old) {
		$type = $this->checkPhotoType($photo, $old);

		if ($type === 'no') {

			return 'no_photo.png';

		} elseif ($type === 'deleted') {

			return $this->deletePhoto($old);

		} elseif ($type === 'same') {

			return $old;

		} elseif ($type === 'new_deleted') {
			$this->deletePhoto($old);

			return $this->uploadPhoto($photo);

		} elseif ($type === 'new') {

			return $this->uploadPhoto($photo);

		}
	}

	private function error($message) {
		return Redirect::back()->withInput()
		               ->withErrors($message);
	}

	private function updateOrCreateItem($fields, $item_id) {
		$fields['photo'] = $this->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);
		unset($fields['category']);

		return $item = Item::updateOrCreate(['item_id' =>  $item_id], $fields);
	}

	private function updateOrCreateArticle($fields, $article_id) {
		$fields['photo'] = $this->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);

		return $article = Article::updateOrCreate(['article_id' => $article_id], $fields);
	}

	private function updateOrCreateProducer($fields, $producer_id) {
		$fields['photo'] = $this->processPhoto($fields['photo'], $fields['old']);
		unset($fields['old']);
		$fields['producer_photo'] = $fields['photo'];
		unset($fields['photo']);

		return $producer = Producer::updateOrCreate(['producer_id' => $producer_id], $fields);
	}

	private function successMessage($item, $item_id) {
		if ($item_id) {
			$message = 'Товар '.$item->title.' изменен! <a href='.URL::to('/admin/change_item?item_id='.$item->item_id).' class="alert-link">Назад</a>';
			return Redirect::back()->with('message', $message);
		} else {
			$message = 'Товар '.$item->title.' добавлен! <a href='.URL::to('/admin/change_item?item_id='.$item->item_id).' class="alert-link">Назад</a>';
			return Redirect::back()->with('message', $message)->withInput();
		}
	}

	private function createValidator($fields, $item_id) {
		$rules = [
			'code'	=> 'required|unique:items,code,'.$item_id.',item_id'
		];

		return  Validator::make($fields, $rules);
	}

	public function updateItem() {
		$item_id = Input::get('item_id');
		$fields = $this->formFields();
		$eurPrice = $this->convertPriceToEur($fields['category'], $fields['price'], $fields['currency']);
		$fields['price'] = $eurPrice['price'];
		$fields['currency'] = $eurPrice['currency'];

		$validator = $this->createValidator($fields, $item_id);

		if ($validator->fails()) {
			$this->error('Товар с таким кодом уже существует. Код должен быть уникальным!');
		} else {
			$item = $this->updateOrCreateItem($fields, $item_id);
			return $this->successMessage($item, $item_id);
		}
	}

	public function deleteItem() {
		$item = Item::find(Input::get('item_id'));

		if ($item->photo != 'no_photo.png') {
			$this->deletePhoto($item->photo);
		}

		$contains = Str::contains(URL::previous(), '/admin/change_item');
		if ($contains) {
			return HELP::__delete('Item', 'Товар %s удален!', 'title', '/admin/change_item');
		} else {
			return HELP::__delete('Item', 'Товар %s удален!', 'title', 'back');
		}
	}

	public function ajaxItemImage() {
		if (Input::hasFile('ajax_photo')) {
			$file = Input::file('ajax_photo');
			$destinationPath = HELP::$ITEM_PHOTO_DIR;
			$extension = $file->getClientOriginalExtension();
			// $temp_filename = $file->getClientOriginalName(); // full

			$filename = 'temp.'.$extension;
			$file->move($destinationPath, $filename);

			$this->addWatermark($filename);
		}

		return Response::json($filename);
	}

	private function addWatermark($filename) {
		$watermark_path = dir_path('icons').dir_sep().'watermark.png';
		$watermark = Image::make($watermark_path);
		$image = Image::make(dir_path('photos').dir_sep().$filename);

		// resize watermark TODO::abstract this part?
		$width = $image->width();
		$height = $image->height();
		$watermark->fit($width, $height);

		$image->insert($watermark, 'center', 0, 0);
		$image->save();
	}

	public function articles() {
		return View::make('new_admin/articles')->with([
			'env' 		=> 'articles',
			'articles'	=> Article::readAllArticles(),
			'pageTitle' => $this->definePageTitle(),
		]);
	}

	public function ajaxDeleteArticle() {
		$article = Article::find(Input::get('article_id'));

		if ($article->photo != 'no_photo.png') {
			$this->deletePhoto($article->photo);
		}

		$article->delete();

		//TODO:: add message?
		return Redirect::back();
	}

	public function changeArticle() {
		return View::make('new_admin/change_article')->with([
			'env' 		=> 'change_article',
			'article'	=> Article::find(Input::get('article_id')),
			'pageTitle' => $this->definePageTitle(),
		]);
	}

	public function updateArticle() {
		$article_id = Input::get('article_id');
		$fields = $this->formArticleFields();

		$article = $this->updateOrCreateArticle($fields, $article_id);

		if ($article_id) {
			$message = 'Новость '.$article->title.' изменена! <a href='.URL::to('/admin/change_article?article_id='.$article->article_id).' class="alert-link">Назад</a>';
			return Redirect::to('/admin/change_article')->with('message', $message);
		} else {
			$message = 'Новость '.$article->title.' добавлена! <a href='.URL::to('/admin/change_article?article_id='.$article->article_id).' class="alert-link">Назад</a>';
			return Redirect::back()->with('message', $message);
		}
	}

	public function deleteArticle() {
		$article = Article::find(Input::get('article_id'));

		if ($article->photo != 'no_photo.png') {
			$this->deletePhoto($article->photo);
		}

		$contains = Str::contains(URL::previous(), '/admin/change_article');
		if ($contains) {
			return HELP::__delete('Article', 'Новость %s удалена!', 'title', '/admin/change_article');
		} else {
			return HELP::__delete('Article', 'Новость %s удалена!', 'title', 'back');
		}
	}

	public function producers() {
		return View::make('new_admin/producers')->with([
			'env' 		=> 'producers',
			'producers' => Producer::readAllProducers(),
			'pageTitle' => $this->definePageTitle(),
		]);
	}

	public function ajaxDeleteProducer() {
		$producer_id = Input::get('producer_id');
		$producer = Producer::find($producer_id);

		Pdf::deleteProducerFromPdfs($producer_id);
		Producer::deleteProducerFromItems($producer_id);

		if ($producer->producer_photo != 'no_photo.png') {
			$this->deletePhoto($producer->producer_photo);
		}

		$producer->delete();

		//TODO:: add message?
		return Redirect::back();
	}

	public function changeProducer() {
		return View::make('new_admin/change_producer')->with([
			'env' 		=> 'change_producer',
			'producer'	=> Producer::find(Input::get('producer_id')),
			'pageTitle' => $this->definePageTitle(),
		]);
	}

	public function updateProducer() {
		$producer_id = Input::get('producer_id');
		$fields = Input::all();

		$producer = $this->updateOrCreateProducer($fields, $producer_id);

		if ($producer_id) {
			$message = 'Производитель '.$producer->producer.' изменен! <a href='.URL::to('/admin/change_producer?producer_id='.$producer->producer_id).' class="alert-link">Назад</a>';
			return Redirect::to('/admin/change_producer')->with('message', $message);
		} else {
			$message = 'Производитель '.$producer->producer.' добавлен! <a href='.URL::to('/admin/change_producer?producer_id='.$producer->producer_id).' class="alert-link">Назад</a>';
			return Redirect::back()->with('message', $message);
		}
	}

	public function deleteProducer() {
		$producer_id = Input::get('producer_id');
		$producer = Producer::find($producer_id);

		Pdf::deleteProducerFromPdfs($producer_id);
		Producer::deleteProducerFromItems($producer_id);

		if ($producer->producer_photo != 'no_photo.png') {
			$this->deletePhoto($producer->producer_photo);
		}

		$contains = Str::contains(URL::previous(), '/admin/change_producer');
		if ($contains) {
			return HELP::__delete('Producer', 'Производитель %s удален!', 'producer', '/admin/change_producer');
		} else {
			return HELP::__delete('Producer', 'Производитель %s удален!', 'producer', 'back');
		}
	}

	public function subcategories() {
		$categories = [
			'Механическое_en' => 'Механическое оборудование (импортное)',
			'Тепловое_en' => 'Тепловое оборудование (импортное)',
			'Холодильное_en' => 'Холодильное оборудование (импортное)',
			'Моечное_en' => 'Моечное оборудование (импортное)',
			'Механическое_ru' => 'Механическое оборудование (российское)',
			'Тепловое_ru' => 'Тепловое оборудование (российское)',
			'Холодильное_ru' => 'Холодильное оборудование (российское)',
			'Моечное_ru' => 'Моечное оборудование (российское)'
		];

		return View::make('new_admin/subcategories')->with([
			'env' 		    => 'subcategories',
			'subcats'       => Subcat::readAllSubcats(),
			'pageTitle'     => $this->definePageTitle(),
		    'categories'    => $categories,
		]);
	}

	public function updateSubcategory() {
		$subcat_id = Input::get('subcat_id');
		$fields = Input::all();

		$rules = [
			'subcat' => 'required|unique:subcats,subcat,NULL,subcat_id,category,'.$fields['category']
		];
		$validator = Validator::make($fields, $rules);

		if ($validator->fails()) {
			return Redirect::back()->withInput()
			               ->withErrors('Подкатегория с таким названием уже существует!');
		} else {
			Subcat::updateOrCreate(['subcat_id' => $subcat_id], $fields);
			return Redirect::back();
		}
	}

	public function ajaxDeleteSubcategory() {
		return HELP::__delete('Subcat', 'Подкатегория %s удалена', 'subcat', '/admin/subcategories');
	}

	public function orders() {
		$orders = new Order();
		$orders = $orders->getAllOrders();

		return View::make('new_admin/orders')->with([
			'env' 		    => 'orders',
			'orders'        => $orders,
			'pageTitle'     => $this->definePageTitle(),
		    'states'        => State::all()
		]);
	}

	public function detailedOrder() {
		$order = new Order();
		$order = $order->getDetailedOrder(Input::get('order_id'));

		return View::make('new_admin/order')->with([
			'env' 		    => 'order',
			'order'         => $order,
			'states'        => State::all(),
			'pageTitle'     => $this->definePageTitle(),
		]);
	}

	public function changeOrderState() {
		$order_id = Input::get('order_id');
		$state_id = Input::get('state');

		$order = Order::find($order_id);
		$order->state = $state_id;
		$order->save();

	}

	public function deleteOrder() {
		$order_id = Input::get('order_id');
		$order = Order::find($order_id);

		$order->deleted = 1;
		$order->save();

		return Redirect::route('admin_orders');
	}

	public function ajaxDeleteOrder() {
		$order_id = Input::get('order_id');
		$order = Order::find($order_id);

		$order->deleted = 1;
		$order->save();
	}

	public function createState() {
		$fields = Input::all();

		$rules = [
			'state_title' => 'required|unique:states,state_title'
		];
		$validator = Validator::make($fields, $rules);

		if ($validator->fails()) {
			return Redirect::back()->withInput()
			               ->withErrors('Статус с таким названием уже существует!');
		} else {
			State::create($fields);
			return Redirect::back();
		}
	}

	public function ajaxUpdateState() {
		$state_id = Input::get('state_id');
		$new_title = Input::get('new_state');

		$state = State::find($state_id);
		$state->state_title = $new_title;

		$state->save();
	}

	public function ajaxDeleteState() {
		$state_id = Input::get('state_id');

		$state = State::find($state_id);

		$state->delete();
	}

	public function clients() {

		return View::make('new_admin/clients')->with([
			'env' 		    => 'clients',
			'clients'       => Client::all(),
			'pageTitle'     => $this->definePageTitle(),
		]);
	}








}