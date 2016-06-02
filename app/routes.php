<?php

// MAIN CONTROLLER
Route::get('/', 'MainController@index');
Route::get('/about', 'MainController@about');
Route::get('/price', 'MainController@price');
Route::get('/get_price', 'MainController@get_price');
Route::get('/delivery', 'MainController@delivery');
Route::get('/specials', 'MainController@specials');
Route::get('/contacts', 'MainController@contacts');
Route::get('/articles', 'MainController@articles');
Route::get('/articles/{article_title}', 'MainController@article');
Route::get('/category/{category}', 'MainController@category');
Route::get('/producers/{producer_title}', 'MainController@byproducer');
Route::post('/user_login', 'MainController@user_login');
Route::get('/registration', 'MainController@registration_page');
Route::post('/registration', 'MainController@registration');
Route::post('/feedback', 'MainController@feedback');
Route::get('/order', 'CartController@order_page');
Route::post('/order', 'CartController@order');
Route::get('/search', 'MainController@search');
Route::post('/user_logout', 'MainController@user_logout');

//CART AND ORDERS
Route::get('/cart', 'CartController@cart');
Route::get('/check', 'CartController@checkCookie');

//PDF
Route::get('/all_pdf', "PdfController@all_pdf");
Route::get('/all_pdf/{producer}', "PdfController@all_pdf_by_prod");
Route::get('/all_pdf/{producer}/{subcat}', "PdfController@all_pdf_by_cat");
Route::get('/one_pdf', "PdfController@one_pdf");

// Route::post('/delete_file_from_server', 'MainController@delete_file_from_server');

// ADMIN OLD CONTROLLER
Route::get('/admin_old', 'AdminController@admin');
Route::post('/admin_old_login', 'AdminController@admin_login');
Route::group(['prefix'=>'/admin_old', 'before'=>'auth2'], function() {
	Route::post('/set_discount', 'AdminController@set_discount');
	Route::post('/set_eur_rate', 'AdminController@set_eur_rate');
	Route::get('/search', 'AdminController@search');
	Route::post('/import', 'AdminController@import');
	Route::post('/admin_logout', 'AdminController@admin_logout');
	Route::get('/catalog', 'AdminController@catalog');
	Route::get('/producers/{producer_title}', 'AdminController@byproducer');

	// PDFS
	Route::get('/list_pdf', 'PdfController@list_pdf');
	Route::post('/delete_pdf', 'PdfController@delete_pdf');
	Route::get('/item_pdfs', 'PdfController@item_pdfs');
	Route::post('/import_pdf', 'PdfController@load_pdf');
	Route::post('/update_pdf', 'PdfController@update_pdf');

	// ARTICLE
	Route::get('/articles', 'AdminController@articles');
	Route::get('/change_article', 'AdminController@change_article');
	Route::post('/update_article', 'AdminController@update_article');
	Route::post('/delete_article', 'AdminController@delete_article');

	// SUBCAT
	Route::get('/subcats', 'AdminController@subcats');
	Route::post('/update_subcat', 'AdminController@update_subcat');
	Route::post('/delete_subcat', 'AdminController@delete_subcat');

	// PRODUCER
	Route::get('/producers', 'AdminController@producers');
	Route::get('/producers_temp', 'AdminController@producer_update_img');
	Route::post('/update_producer', 'AdminController@update_producer');
	Route::post('/delete_producer', 'AdminController@delete_producer');

	// AJAX
	Route::post('/ajax_change_subcat', 'AdminController@ajax_change_subcat');
	Route::post('/ajax_change_pdf', 'PdfController@ajax_change_pdf');
	Route::post('/ajax_set_special', 'AdminController@ajax_set_special');
	Route::post('/ajax_set_hit', 'AdminController@ajax_set_hit');
	Route::post('/ajax_set_procurement', 'AdminController@ajax_set_procurement');
	Route::post('/ajax_delete_group', 'AdminController@ajax_delete_group');
	Route::post('/ajax_get_subcats', 'AdminController@ajax_get_subcats');
	Route::post('/ajax_item_image', 'AdminController@ajax_item_image');
	
	// ITEM
	Route::get('/change_item', 'AdminController@change_item');
	Route::post('/update_item', 'AdminController@update_item');
	Route::post('/delete_item', 'AdminController@delete_item');
	Route::post('/delete_item_from_pdf', 'PdfController@delete_item_from_pdf');
	Route::get('/{category}/{subcat}', 'AdminController@items');

	//ADMINS
	Route::post('/new_admin', 'AdminController@new_admin');
	Route::get('/list_admins', 'AdminController@list_admins');
	Route::post('/delete_admin', 'AdminController@delete_admin');
	Route::post('/update_admin', 'AdminController@update_admin');

	//ORDERS

});







// NEW ADMIN CONTROLLER
Route::get('/admin', array('as' => 'dashboard', 'uses' => 'NewAdminController@admin'));
//Route::post('/admin_login', 'AdminController@admin_login');
Route::group(['prefix'=>'/admin', 'before'=>'auth2'], function() {
	//DASHBOARD
	Route::get('/new-admins-after-last-visit/{last_visit}', array('as' => 'new_admins_after', 'uses' => 'NewAdminController@newAdminsAfterVisit'));
	Route::get('/new-clients-after-last-visit/{last_visit}', array('as' => 'new_clients_after', 'uses' => 'NewAdminController@newClientsAfterVisit'));
	Route::get('/new-orders-after-last-visit/{last_visit}', array('as' => 'new_orders_after', 'uses' => 'NewAdminController@newOrdersAfterVisit'));
	Route::get('/new-users-after-last-visit/{last_visit}', array('as' => 'new_users_after', 'uses' => 'NewAdminController@newUsersAfterVisit'));
	Route::get('/new-articles-after-last-visit/{last_visit}', array('as' => 'new_articles_after', 'uses' => 'NewAdminController@newArticlesAfterVisit'));
	Route::post('/toggle_item_hit/{id}', 'NewAdminController@toggleItemHit');
	Route::post('/mark-order-as-done/{id}', 'NewAdminController@markOrderAsDone');
	Route::get('/catalog', array('as' => 'catalog_admin', 'uses' => 'NewAdminController@catalog'));

	// ITEM
	Route::get('/{category}/{subcat}', array('as' => 'items_admin', 'uses' => 'NewAdminController@items'));
	Route::get('/change_item', array('as' => 'items_admin_change', 'uses' => 'NewAdminController@changeItem'));
	Route::post('/update_item', 'NewAdminController@updateItem');
	Route::post('/delete_item', 'NewAdminController@deleteItem');
	Route::post('/delete_item_from_pdf', 'PdfController@delete_item_from_pdf');

	// AJAX
	Route::post('/ajax-change-subcategory', 'NewAdminController@changeSubcategory');
	Route::post('/ajax-change-pdf', 'PdfController@ajax_change_pdf');
	Route::post('/ajax-make-special', 'NewAdminController@setSpecial');
	Route::post('/ajax-make-hit', 'NewAdminController@setHit');
	Route::post('/ajax-set-procurement', 'NewAdminController@setProcurement');
	Route::post('/ajax-delete-group', 'NewAdminController@deleteGroup');
	Route::post('/ajax-delete-item', 'NewAdminController@ajaxDeleteItem');
	Route::post('/ajax-get-subcategories', 'NewAdminController@getSubcategories');
	Route::post('/ajax_item_image', 'NewAdminController@ajaxItemImage');

	// ARTICLE
	Route::get('/articles', array('as' => 'articles_admin', 'uses' => 'NewAdminController@articles'));
	Route::get('/change_article', array('as' => 'article_admin_change', 'uses' => 'NewAdminController@changeArticle'));
	Route::post('/update_article', array('as' => 'article_admin_change', 'uses' => 'NewAdminController@updateArticle'));
	Route::post('/delete_article', 'NewAdminController@deleteArticle');
	Route::post('/ajax-delete-article', 'NewAdminController@ajaxDeleteArticle');

	// PRODUCER
	Route::get('/producers', array('as' => 'admin_producer', 'uses' => 'NewAdminController@producers'));
	Route::get('/change_producer', array('as' => 'admin_producer_change', 'uses' => 'NewAdminController@changeProducer'));
	Route::post('/update_producer', 'NewAdminController@updateProducer');
	Route::post('/ajax-delete-producer', 'NewAdminController@ajaxDeleteProducer');
	Route::post('/delete_producer', 'NewAdminController@deleteProducer');

	// SUBCATEGORIES
	Route::get('/subcategories', array('as' => 'admin_subcategories', 'uses' => 'NewAdminController@subcategories'));
	Route::post('/update_subcategory', 'NewAdminController@updateSubcategory');
	Route::post('/ajax-delete-subcategory', 'NewAdminController@ajaxDeleteSubcategory');

	//ORDERS
	Route::get('/orders', array('as' => 'admin_orders', 'uses' => 'NewAdminController@orders'));
	Route::get('/detailed_order', array('as' => 'admin_order', 'uses' => 'NewAdminController@detailedOrder'));
	Route::post('/change-order-state', 'NewAdminController@changeOrderState');
	Route::post('/ajax-delete-order', 'NewAdminController@ajaxDeleteOrder');
	Route::post('/delete_order', 'NewAdminController@deleteOrder');

	//STATES
	Route::post('/create_state', 'NewAdminController@createState');
	Route::post('/ajax-update-state', 'NewAdminController@ajaxUpdateState');
	Route::post('/ajax-delete-state', 'NewAdminController@ajaxDeleteState');

	//CLIENTS
	Route::get('/clients', array('as' => 'admin_clients', 'uses' => 'NewAdminController@clients'));
	Route::get('/detailed_client', array('as' => 'admin_client', 'uses' => 'NewAdminController@client'));

	//USERS
	Route::get('/users', array('as' => 'admin_users', 'uses' => 'NewAdminController@users'));
	Route::get('/detailed_user', array('as' => 'admin_user', 'uses' => 'NewAdminController@user'));

	// PDFS
	Route::get('/create_pdf',  array('as' => 'create_pdf', 'uses' => 'NewAdminController@createPdf'));
	Route::post('/load_pdf', 'NewAdminController@loadPdf');
	Route::get('/list_pdf',  array('as' => 'admin_pdfs', 'uses' => 'NewAdminController@listPdf'));
	Route::get('/change_pdf',  array('as' => 'admin_pdf', 'uses' => 'NewAdminController@changePdf'));
	Route::post('/update_pdf', 'NewAdminController@updatePdf');
	Route::post('/ajax-delete-pdf', 'NewAdminController@ajaxDeletePdf');
	Route::post('/delete_pdf', 'NewAdminController@deletePdf');
	//Route::get('/item_pdfs', 'PdfController@item_pdfs');

	//ADMINS
	Route::get('/list_admins', array('as' => 'admins', 'uses' => 'NewAdminController@admins'));
	//Route::post('/new_admin', 'AdminController@new_admin');
	//Route::post('/delete_admin', 'AdminController@delete_admin');
	//Route::post('/update_admin', 'AdminController@update_admin');





	//	Route::post('/set_discount', 'AdminController@set_discount');
	//	Route::post('/set_eur_rate', 'AdminController@set_eur_rate');
	//	Route::get('/search', 'AdminController@search');
	//	Route::post('/import', 'AdminController@import');
	//	Route::post('/admin_logout', 'AdminController@admin_logout');
//	Route::get('/producers/{producer_title}', 'AdminController@byproducer');
//
//	// PDFS
//	Route::get('/list_pdf', 'PdfController@list_pdf');
//	Route::post('/delete_pdf', 'PdfController@delete_pdf');
//	Route::get('/item_pdfs', 'PdfController@item_pdfs');
//	Route::post('/import_pdf', 'PdfController@load_pdf');
//	Route::post('/update_pdf', 'PdfController@update_pdf');
//
//	// ARTICLE
//	Route::get('/articles', 'AdminController@articles');
//	Route::get('/change_article', 'AdminController@change_article');
//	Route::post('/update_article', 'AdminController@update_article');
//	Route::post('/delete_article', 'AdminController@delete_article');
//
//	// SUBCAT
//	Route::get('/subcats', 'AdminController@subcats');
//	Route::post('/update_subcat', 'AdminController@update_subcat');
//	Route::post('/delete_subcat', 'AdminController@delete_subcat');
//
//	// PRODUCER
//	Route::get('/producers', 'AdminController@producers');
//	Route::get('/producers_temp', 'AdminController@producer_update_img');
//	Route::post('/update_producer', 'AdminController@update_producer');
//	Route::post('/delete_producer', 'AdminController@delete_producer');
//
//	// AJAX
//	Route::post('/ajax_change_subcat', 'AdminController@ajax_change_subcat');
//	Route::post('/ajax_change_pdf', 'PdfController@ajax_change_pdf');
//	Route::post('/ajax_set_special', 'AdminController@ajax_set_special');
//	Route::post('/ajax_set_hit', 'AdminController@ajax_set_hit');
//	Route::post('/ajax_set_procurement', 'AdminController@ajax_set_procurement');
//	Route::post('/ajax_delete_group', 'AdminController@ajax_delete_group');
//	Route::post('/ajax_get_subcats', 'AdminController@ajax_get_subcats');
//	Route::post('/ajax_item_image', 'AdminController@ajax_item_image');
//
//	// ITEM
//	Route::get('/change_item', 'AdminController@change_item');
//	Route::post('/update_item', 'AdminController@update_item');
//	Route::post('/delete_item', 'AdminController@delete_item');
//	Route::post('/delete_item_from_pdf', 'PdfController@delete_item_from_pdf');
//	Route::get('/{category}/{subcat}', 'AdminController@items');
//
//	//ADMINS
//	Route::post('/new_admin', 'AdminController@new_admin');
//	Route::get('/list_admins', 'AdminController@list_admins');
//	Route::post('/delete_admin', 'AdminController@delete_admin');
//	Route::post('/update_admin', 'AdminController@update_admin');

	//ORDERS

});
Route::get('/{category}/{subcat}', 'MainController@prods_by_subcat');
Route::get('/{category}/{subcat}/{producer}/items', 'MainController@items_by_subcat_prod');
Route::get('/{category}/{subcat}/{item_title}', 'MainController@item');

//Route::get('run_watermark_stamping', function() {
//	// $filenames = read_dir(dir_path('photos'));
//	// $watermark_path = dir_path('icons').dir_sep().'watermark.png';
//	// $watermark = Image::make($watermark_path);
//	// $watermark->backup();
//
//	// foreach ($filenames as $filename) {
//	// 	$watermark->reset();
//	// 	$image = Image::make(dir_path('photos').dir_sep().$filename);
//
//	// 	// resize watermark
//	// 	$width = $image->width();
//	// 	$height = $image->height();
//	// 	// $watermark->resize($width, $height);
//	// 	$watermark->fit($width, $height);
//
//	// 	$image->insert($watermark, 'center', 0, 0);
//	// 	$image->save();
//	// }
//
//	// // Image::canvas(800, 600, '#ccc');
//	// // $img = Image::make('foo.jpg')->resize(300, 200);
//	// // return $img->response('jpg');
//
//	// // $img->save('public/bar.jpg');
//	// // Image::make('public/foo.jpg')->resize(320, 240)->insert('public/watermark.png');
//});

