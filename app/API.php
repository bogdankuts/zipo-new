<?php
// test user login
// email 	= vasiliyvertex@gmail.com
// password = vertex

private function overall() {
// <-$user_id from session
// ->$subcats = [
// 	'foreign'  => [
// 		'category1' => [],
// 		'category2' => [],
// 		'category3' => [],
// 		'category4' => []
// 	],
// 	'domestic' => [
// 		'category1' => [],
// 		'category2' => [],
// 		'category3' => [],
// 		'category4' => []
// 	]
// ]
// ->$articles = [n*Article]
// ->$recents = [4*Recent]
// ->$user = User
// ->$message = 'error'
}

Route::get('/', 'MainController@index');
// view(index)
// ->$producers = [n*Producer]
// ->$env = 'catalog'
// overall()

Route::get('/about', 'MainController@about');
// view(about)
// ->$env = 'about'
// overall()

Route::get('/price', 'MainController@price');
// view(price)
// ->$prices = [5*'excel_file_name']
// ->$env = 'price'
// overall()

Route::get('/det_price?price_id', 'MainController@get_price');
// <-$price_id from get params
// ->download price
// redirect - ???

Route::get('/delivery', 'MainController@delivery');
// view(delivery)
// ->$env = 'delivery'
// overall()

Route::get('/specials', 'MainController@specials');
// view(items)
// ->$specials = [n*Item]
// ->$env = 'specials'
// overall()

Route::get('/contacts', 'MainController@contacts');
// view(contacts)
// ->$env = 'contacts'
// overall() fill form with User creds

Route::get('category/{category}', 'MainController@category');
// view(one_category)
// <-$category
// <-$sub_cat_id from get
// ->$env = 'catalog'
// ->$subcats by category
// overall()

Route::get('/{category}/{subcat}', 'MainController@items');
// view(items)
// <-$subcat_id from get params
// ->$env = 'catalog'
// ->$current breadcrumbs
// ->$items = [n*Item] sort by hit and Input::get('sort');  Input::get('order'); paginate by Input::get('by');
// -> $current;
// overall()

Route::get('/{category}/{subcat}/{item_title}', 'MainController@item');
// view(item)
// <-$category
// <-$subcat
// <-$item_code from get params Input::get('code'); // second arg is default
// store item_code to recent table by user_id
// ->$env = 'catalog'
// ->$current breadcrumbs
// ->$item = Item by item_code
// ->$same = [4*Item] from same subcategory
// overall()

Route::get('/articles', 'MainController@articles');
// view(articles)
// overall() with all articles

Route::get('/articles/article_title', 'MainController@article');
// view(article)
// <-$article_id from get params
// ->$article by article_id
// overall()

Route::get('/producers/{producer_title}', 'MainController@byproducer');
// view(items)
// <-$producer_title
// ->$items = [n*Item] by producer_title sort by hit and Input::get('sort');  Input::get('order'); paginate by Input::get('by');
// overall()

Route::post('/user_login', 'MainController@user_login');
// <-$creds from user_login_form
// redirect('/') with message on error

Route::get('/registration', 'MainController@registration_page');
// view(registration)

Route::post('/registration', 'MainController@registration')
// <-$regs from registration_form
// redirect('/') with congratulation message
// redirect('/registration') with message on error

Route::post('/feedback', 'MainController@feedback');
// <-$feed from feedback_form
// redirect('/contacts') with thanks message

Route::get('/order/{item_title}/{item_code}', 'MainController@order_page');
// view(order)
// <-$item_title
// <-$item_code
// overall() fill form with User creds, item_title and item_code

Route::post('/order', 'MainController@order');
// <-$order from order_form
// redirect('') with thanks message

Route::get('/search/{query}', 'MainController@search');
// view(items)
// <-$query
// ->$items = [n*Item] search by title, description, code sort by hit and Input::get('sort');  Input::get('order'); paginate by Input::get('by');
// overall()

Route::get('/logout', 'MainController@logout');
// redirect('/')
