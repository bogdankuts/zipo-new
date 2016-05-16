<?php
class AdminController extends BaseController {
	public function admin() {
//		print_r(Auth::admin()->get()->master);
//		exit;
//		print_r(Cache::get('EUR_rate'));
//		exit;
//		Cache::forget('EUR_rate');
		if (Auth::admin()->check()) {
			return View::make('admin/admin')->with([
				'env' 				=> 'panel',
				'producers' 		=> Producer::all(),
				'discount'  		=> Setting::getDiscount(),
				'current_EUR_rate'  => get_EUR_rate(),
			]);
		} else {
			return View::make('admin/admin_login');
		}
	}

	public function new_admin() {
		if(Auth::admin()->get()->master == '1') {
			$fields = Input::all();
			$fields['password'] = Hash::make($fields['password']);
			//		print_r($fields);
			//		exit;
			Cred::create($fields);
			return Redirect::to('/admin')->with('message', 'Новый администратор с имененм '.$fields['login'].' добавлен');
		} else {
			return Redirect::to('/admin')->withErrors('У Вас нет прав для совершения этого действия');
		}
	}

	public function list_admins() {
		if(Auth::admin()->get()->master == '1') {
			return View::make('admin/admin_admins_list')->with(['admins' => Cred::all()]);
		} else {
			return Redirect::to('/admin')->withErrors('У Вас нет прав для совершения этого действия');
		}
	}

	public function update_admin() {
		$fields = Input::all();
		$admin_id = Input::get('cred_id');
		$fields['password'] = Hash::make($fields['password']);
		if(Auth::admin()->get()->master == '1') {
			Cred::find($admin_id)->update($fields);
			return Redirect::back()->with('message', 'Admin изменен успешно.');
		} else {
			return Redirect::to('/admin')->withErrors('У Вас нет прав для совершения этого действия');
		}
	}

	public function delete_admin() {
		if(Auth::admin()->get()->master == '1') {
			Cred::destroy(Input::get('cred_id'));
			return Redirect::back();
		} else {
			return Redirect::to('/admin')->withErrors('У Вас нет прав для совершения этого действия');
		}
	}

	public function admin_login() {
		$creds = [
			'password'	=> Input::get('password'),
			'login' 	=> Input::get('login')
		];

		$pass = Auth::admin()->attempt($creds, true);
		if ($pass) {
			return Redirect::to('admin');
		} else {
			return Redirect::to('admin')
				->withErrors('Неверный логин или пароль!');
		}
	}

	public function set_discount() {
		$discount = Input::get('discount');
		Setting::setDiscount();

		return Redirect::to('/admin')->with('message', 'Скидка для зарегестрированных пользователей: '.$discount.'%.');
	}

	public function set_eur_rate() {
		$rate = str_replace(',', '.', Input::get('rate'));
		$left = minutes_left();
		Cache::put('EUR_rate', $rate, $left);

		return Redirect::to('/admin')->with('message', 'Курс евро на текущий день установлен: '.$rate.' рублей за 1 евро.');
	}

	public function search() {
		$items = Item::getItemsByQueryAdmin();
		$query = Input::get('query');

		if ($items->count() == 0) {
			return Redirect::to('/admin')->withErrors('По запросу: "'.$query.'" ничего не найдено.');
		} else {
			return View::make('admin/admin_items')->with([
				'pdfs'		=> Pdf::all(),
				'items'     => Item::getItemsByQueryAdmin(),
				'current'	=> $query,
				'env' 		=> 'search'
			]);
		}
	}

	public function import() {
		if (Input::hasFile('excel')) {
			$file = Input::file('excel');
			$destinationPath = HELP::$EXCEL_IMPORT_DIR;
			$extension = $file->getClientOriginalExtension();
			if ($extension != 'xlsx') {
				return Redirect::to('/admin')->withErrors('Выбранный файл должен иметь формат .xlsx');
			}
			// $filename = $file->getClientOriginalName(); // full
			$filename = 'excel.'.$extension;
			$file->move($destinationPath, $filename);

			// returns import_status view
			return App::make('ExcelController')->excelImport();
		} else {
			return Redirect::to('/admin')->withErrors('Excel файл не выбран!');
		}
	}

	public function admin_logout() {
		Auth::admin()->logout();
		return Redirect::to('/');
	}

	public function catalog() {
		return View::make('admin/admin_catalog')->with([
			'env' 		=> 'catalog_admin',
			'subcats'   => Subcat::readAllSubcats(),
			'producers' => Producer::readAllProducers(),
		]);
	}

	public function byproducer() {
		return View::make('admin/admin_items')->with([
			'pdfs'		=> Pdf::all(),
			'env' 		=> 'byproducer',
			'current'	=> Producer::find(Input::get('producer_id')),
			'items' 	=> Item::getItemsByProducerAdmin(),
		]);
	}

	public function items() {
		return View::make('admin/admin_items')->with([
			'pdfs'		=> Pdf::all(),
			'current'	=> Subcat::find(Input::get('subcat_id')),
			'env' 		=> 'catalog_admin',
			'items'     => Item::getItemsForAdminCatalog()
		]);
	}

	public function change_item() {
		return View::make('admin/admin_change_item')->with([
			'env' 		=> 'change_item',
			'item'		=> Item::__items()->find(Input::get('item_id')), // or use Model::findOrFail(1); if need to show delete button everywere
			'producers' => Producer::readAllProducers()
		]);
	}

	public function update_item() {
		$item_id = Input::get('item_id');
		$fields = Input::all();
		if (!isset($fields['procurement'])) {
           		$fields['procurement'] = 0;
       		}
	        if (!isset($fields['special'])) {
	            $fields['special'] = 0;
	        }
	        if (!isset($fields['hit'])) {
	            $fields['hit'] = 0;
	        }
		$photo = Input::get('photo');
		$old = Input::get('old');


		/*------------------------------------------------
		| convert to EUR
		------------------------------------------------*/
		$categories = en_categories();
		if (in_array($fields['category'], $categories) and 'РУБ' == $fields['currency']) {
			$fields['currency'] = 'EUR';
			$fields['price'] = ceil($fields['price']/get_EUR_rate()*100)/100;
		}	
		/*----------------------------------------------*/


		unset($fields['old']);
		unset($fields['category']);
		
		$rules = [
			'code'	=> 'required|unique:items,code,'.$item_id.',item_id'
		];

		$validator = Validator::make($fields, $rules);

		// createnig and updting
		if ($photo != 'no_photo.png'  && $photo != $old) {
			if ($old != 'no_photo.png') {
				$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
				File::delete($filepath);
				$fields['photo'] = 'no_photo.png';
			}

			$old = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$photo;
			$extension = File::extension($old);
			$filename = 'photo_'.time().'.'.$extension;
			$new = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$filename;
			rename($old, $new);
			$fields['photo'] = $filename;
		}

		// deleting photo
		if ($photo == 'no_photo.png' && $old != 'no_photo.png') {
			$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
			File::delete($filepath);
			$fields['photo'] = 'no_photo.png';
		}

		if ($validator->fails()) {
			return Redirect::back()->withInput()
				->withErrors('Товар с таким кодом уже существует. Код должен быть уникальным!');
		} else {
			$item = Item::updateOrCreate(['item_id' => $item_id], $fields);
		}

		if ($item_id) {
			$message = 'Товар '.$item->title.' изменен! <a href='.URL::to('/admin/change_item?item_id='.$item->item_id).' class="alert-link">Назад</a>';
			return Redirect::back()->with('message', $message);
		} else {
			$message = 'Товар '.$item->title.' добавлен! <a href='.URL::to('/admin/change_item?item_id='.$item->item_id).' class="alert-link">Назад</a>';
			return Redirect::back()->with('message', $message)->withInput();
		}
	}

	public function delete_item() {
		$item = Item::find(Input::get('item_id'));
		if ($item->photo != 'no_photo.png') {
			$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$item->photo;
			File::delete($filepath);
		}

		$contains = Str::contains(URL::previous(), '/admin/change_item');
		if ($contains) {
			return HELP::__delete('Item', 'Товар %s удален!', 'title', '/admin/change_item');
		} else {
			return HELP::__delete('Item', 'Товар %s удален!', 'title', 'back');
		}
	}

	public function articles() {
		return View::make('admin/admin_articles')->with([
			'env' 		=> 'articles',
			'articles'	=> Article::readAllArticles(),
		]);
	}

	public function change_article() {
		return View::make('admin/admin_change_article')->with([
			'env' 		=> 'change_article',
			'article'	=> Article::find(Input::get('article_id'))
		]);
	}

	public function update_article() {
		$article_id = Input::get('article_id');
		$fields = Input::all();
		$photo = Input::get('photo');
		$old = Input::get('old');
		unset($fields['old']);
		$today = date("Y-m-d", time());
		$fields['time'] = $today;
		
		// createnig and updting
		if ($photo != 'no_photo.png' && $photo != $old) {
			if ($old != 'no_photo.png') {
				$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
				File::delete($filepath);
				$fields['photo'] = 'no_photo.png';
			}

			$old = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$photo;
			$extension = File::extension($old);
			$filename = 'photo_'.time().'.'.$extension;
			$new = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$filename;
			rename($old, $new);
			$fields['photo'] = $filename;
		}

		// deleting photo
		if ($photo == 'no_photo.png' && $old != 'no_photo.png') {
			$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
			File::delete($filepath);
			$fields['photo'] = 'no_photo.png';
		}

		$article = Article::updateOrCreate(['article_id' => $article_id], $fields);

		if ($article_id) {
			$message = 'Новость '.$article->title.' изменена! <a href='.URL::to('/admin/change_article?article_id='.$article->article_id).' class="alert-link">Назад</a>';
			return Redirect::to('/admin/change_article')->with('message', $message);
		} else {
			$message = 'Новость '.$article->title.' добавлена! <a href='.URL::to('/admin/change_article?article_id='.$article->article_id).' class="alert-link">Назад</a>';
			return Redirect::back()->with('message', $message);
		}
	}

	public function delete_article() {
		$article = Article::find(Input::get('article_id'));
		if ($article->photo != 'no_photo.png') {
			$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$article->photo;
			File::delete($filepath);
		}

		$contains = Str::contains(URL::previous(), '/admin/change_article');
		if ($contains) {
			return HELP::__delete('Article', 'Новость %s удалена!', 'title', '/admin/change_article');
		} else {
			return HELP::__delete('Article', 'Новость %s удалена!', 'title', 'back');
		}
	}

	public function subcats() {
		return View::make('admin/admin_subcats')->with([
			'env' 		=> 'subcats',
			'subcats'   => Subcat::readAllSubcats(),
		]);
	}

	public function update_subcat() {
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
			$subcat = Subcat::updateOrCreate(['subcat_id' => $subcat_id], $fields);
			return Redirect::back();
		}
	}

	public function delete_subcat() {
		return HELP::__delete('Subcat', 'Подкатегория %s удалена', 'subcat', '/admin/subcats');
	}

	public function producers() {
		return View::make('admin/admin_producers')->with([
			'env' 		=> 'producers',
			'producers' => Producer::readAllProducers(),
		]);
	}

	public function producer_update_img() {
		$producers = Producer::all();
		foreach ($producers as $producer) {
			$producer->photo = 'no_photo.png';
			$producer->save();
		}
	}

	public function update_producer() {
		$producer_id = Input::get('producer_id');
		$producer = Producer::find($producer_id);
		$fields = Input::all();
		$photo = Input::get('photo');
		$old = Input::get('old');
		unset($fields['old']);

		$rules = [
			'producer' => 'required|unique:producers'
		];
		$validator = Validator::make($fields, $rules);

		if ($validator->fails()) {
			// createnig and updting
			if ($photo != 'no_photo.png' && $photo != $old) {
				if ($old != 'no_photo.png') {
					$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
					File::delete($filepath);
					$fields['photo'] = 'no_photo.png';
				}

				$old = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$photo;
				$extension = File::extension($old);
				$filename = 'photo_'.time().'.'.$extension;
				$new = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$filename;
				rename($old, $new);
				$fields['photo'] = $filename;
			}

			// deleting photo
			if ($photo == 'no_photo.png' && $old != 'no_photo.png') {
				$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
				File::delete($filepath);
				$fields['photo'] = 'no_photo.png';
			}
			Producer::updateOrCreate(['producer_id' => $producer_id], $fields);
			$message = 'Производитель '.$producer->title.' изменен!';
			return Redirect::back()->withInput()
				->with('message', $message);
		} else {
			// createnig and updting
			if ($photo != 'no_photo.png' && $photo != $old) {
				if ($old != 'no_photo.png') {
					$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
					File::delete($filepath);
					$fields['photo'] = 'no_photo.png';
				}

				$old = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$photo;
				$extension = File::extension($old);
				$filename = 'photo_'.time().'.'.$extension;
				$new = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$filename;
				rename($old, $new);
				$fields['photo'] = $filename;
			}

			// deleting photo
			if ($photo == 'no_photo.png' && $old != 'no_photo.png') {
				$filepath = HELP::$ITEM_PHOTO_DIR.DIRECTORY_SEPARATOR.$old;
				File::delete($filepath);
				$fields['photo'] = 'no_photo.png';
			}

			Producer::updateOrCreate(['producer_id' => $producer_id], $fields);

			if ($producer_id) {
				$message = 'Производитель '.$producer->title.' изменен!';
				return Redirect::to('/admin/change_article')->with('message', $message);
			} else {
				$message = 'Производитель \'.$producer->title. добавлен!';
				return Redirect::back()->with('message', $message);
			}
			return Redirect::back();
		}
	}

	public function delete_producer() {
		return HELP::__delete('Producer', 'Производитель %s удален', 'producer', '/admin/producers');
		//TODO::fix delete(set->good producer to other);

	}

/*------------------------------------------------
| AJAX
------------------------------------------------*/
	public function ajax_change_subcat() {
		$ids = Input::get('ids');
		$fields = Input::all();
		unset($fields['ids']);

		Item::whereIn('item_id', $ids)->update($fields);
		return Response::json($ids);
	}

	public function ajax_set_special() {
		$ids = Input::get('ids');

		Item::whereIn('item_id', $ids)->update(['special' => DB::raw('!special')]);
		return Response::json($ids);
	}

	public function ajax_set_hit() {
		$ids = Input::get('ids');

		Item::whereIn('item_id', $ids)->update(['hit' => DB::raw('!hit')]);
		return Response::json($ids);
	}

	public function ajax_set_procurement() {
		$ids = Input::get('ids');

		Item::whereIn('item_id', $ids)->update(['procurement' => DB::raw('!procurement')]);
		return Response::json($ids);
	}

	public function ajax_delete_group() {
		$ids = Input::get('ids');

		Item::destroy($ids);
		return Response::json($ids);
	}
/*----------------------------------------------*/

	public function ajax_get_subcats() {
		$category = Input::get('category');
		$all = Subcat::readAllSubcats();
		$subcats = $all[$category];
		return Response::json($subcats);
	}

	public function ajax_item_image() {
		if (Input::hasFile('ajax_photo')) {
			$file = Input::file('ajax_photo');
			$destinationPath = HELP::$ITEM_PHOTO_DIR;
			$extension = $file->getClientOriginalExtension();
			// $temp_filename = $file->getClientOriginalName(); // full
			$filename = 'temp.'.$extension;
			$file->move($destinationPath, $filename);

			/*------------------------------------------------
			| ADD WATERMARK
			------------------------------------------------*/
			// $filenames = read_dir(dir_path('photos'));
			$watermark_path = dir_path('icons').dir_sep().'watermark.png';
			$watermark = Image::make($watermark_path);
			$image = Image::make(dir_path('photos').dir_sep().$filename);

			// resize watermark
			$width = $image->width();
			$height = $image->height();
			$watermark->fit($width, $height);

			$image->insert($watermark, 'center', 0, 0);
			$image->save();
			/*----------------------------------------------*/
		}

		return Response::json($filename);
	}

	// public function delete_file_from_server() {
	// 	$filepath = Input::get('filepath');
	// 	File::delete($filepath);
	// 	return Response::json('file '.$filepath.' deleted');
	// }
}