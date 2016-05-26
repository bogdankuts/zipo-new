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
		} elseif ($route == 'items_admin_change') {
			return $title = 'Добавление/Изменение товара';
		} elseif ($route == 'articles_admin') {
			return $title = 'Статьи';
		} elseif ($route == 'article_admin_change') {
			return $title = 'Добавление/Изменение статьи';
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

	private function converPriceToEur($category, $price, $currency) {
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
		$eurPrice = $this->converPriceToEur($fields['category'], $fields['price'], $fields['currency']);
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




}