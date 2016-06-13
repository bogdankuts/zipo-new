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


// NEW ADMIN CONTROLLER
Route::get('/admin', array('as' => 'dashboard', 'uses' => 'NewAdminController@admin'));
Route::post('/admin_login', 'NewAdminController@adminLogin');
Route::post('/admin/admin_logout', 'NewAdminController@adminLogout');
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
	Route::post('/set_discount', 'NewAdminController@setDiscount');
	Route::post('/set_eur_rate', 'NewAdminController@setEurRate');
	Route::post('/import', 'NewAdminController@import');
	Route::get('/search', array('as' => 'search', 'uses' => 'NewAdminController@search'));


	// ITEM
	Route::get('/producers/{producer_title}', array('as' => 'items_admin', 'uses' => 'NewAdminController@byProducer'));
	Route::get('/{category}/{subcat}', array('as' => 'items_admin', 'uses' => 'NewAdminController@items'));
	Route::get('/no_title_items', array('as' => 'items_admin', 'uses' => 'NewAdminController@noTitleItems'));
	Route::get('/no_description_items', array('as' => 'items_admin', 'uses' => 'NewAdminController@noDescriptionItems'));
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
	Route::get('/no_title_articles', array('as' => 'articles_admin', 'uses' => 'NewAdminController@noTitleArticles'));
	Route::get('/no_description_articles', array('as' => 'articles_admin', 'uses' => 'NewAdminController@noDescriptionArticles'));
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
	Route::get('/change_admin', array('as' => 'change_admin', 'uses' => 'NewAdminController@changeAdmin'));
	Route::get('/list_admins', array('as' => 'admins', 'uses' => 'NewAdminController@admins'));
	Route::post('/update_admin', 'NewAdminController@updateAdmin');
	Route::post('/ajax-delete-admin', 'NewAdminController@ajaxDeleteAdmin');
	Route::post('/delete_admin', 'NewAdminController@deleteAdmin');
	//Route::post('/new_admin', array('as' => 'new_admin', 'uses' => 'NewAdminController@newAdmin'));

	Route::get('/about', array('as' => 'about', 'uses' => 'NewAdminController@about'));
});


Route::get('/{category}/{subcat}', 'MainController@prods_by_subcat');
Route::get('/{category}/{subcat}/{producer}/items', 'MainController@items_by_subcat_prod');
Route::get('/{category}/{subcat}/{item_title}', 'MainController@item');

