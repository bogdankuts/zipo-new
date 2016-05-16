<?php

class ResponsesTest extends TestCase {

	public function setUp() {
		parent::setUp();
		Session::start();
		Route::enableFilters();
	}

	// public function testIndex() {
	// 	$this->call('GET', '/');
	// 	$this->assertResponseOk();
	// }

	// public function testAbout() {
	// 	$this->call('GET', '/about');
	// 	$this->assertResponseOk();
	// }

	// public function testPrice() {
	// 	$this->call('GET', '/price');
	// 	$this->assertResponseOk();
	// }

	// // public function testGet_price() {
	// // 	$this->call('GET', '/get_price?price_id=1');
	// // 	$this->assertResponseOk();
	// // }

	// public function testDelivery() {
	// 	$this->call('GET', '/delivery');
	// 	$this->assertResponseOk();
	// }

	// public function testSpecials() {
	// 	$this->call('GET', '/specials');
	// 	$this->assertResponseOk();
	// }

	// public function testContacts() {
	// 	$this->call('GET', '/contacts');
	// 	$this->assertResponseOk();
	// }

	// public function testArticles() {
	// 	$this->call('GET', '/articles');
	// 	$this->assertResponseOk();
	// }

	// public function testArticle() {
	// 	$this->call('GET', '/articles/article_title?article_id=1');
	// 	$this->assertResponseOk();
	// }

	// public function testCategory() {
	// 	$this->call('GET', '/category/mehanicheskoe_en');
	// 	$this->assertResponseOk();
	// }

	// public function testByProducer() {
	// 	$this->call('GET', '/producers/producer_title?producer_id=1');
	// 	$this->assertResponseOk();
	// }

	public function testUser_login() {
		$creds = array(
			'email'=>'vasiliyvertex@gmail.com',
			'password'=>'vertex',
			'csrf_token' => csrf_token()
		);

		$response = $this->action('POST', 'MainController@user_login', null, $creds); 
		$this->data = $response->original->getData();
		// $this->assertRedirectedTo('/');
		$this->assertTrue(Auth::user()->check());
	}

/*------------------------------------------------
| ADMIN AREA
------------------------------------------------*/
	public function testLogin() 
	{
		$this->call('GET', '/admin');
		$this->assertResponseOk();
	}
}



	// $this->assertSessionHas('email');
	// $this->assertSessionHasErrors('name');


	// public function testShouldDoLogin() {
	// // provide post input

	// $credentials = array(
	//         'email'=>'admin',
	//         'password'=>'admin',
	//         'csrf_token' => csrf_token()
	// );

	// $response = $this->action('POST', 'UserController@postLogin', null, $credentials); 

	// // if success user should be redirected to homepage
	// $this->assertRedirectedTo('/');
	// }