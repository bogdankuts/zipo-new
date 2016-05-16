<?php

// class APITest extends TestCase {

// 	public function testIndex()
// 	{
// 		$response = $this->call('GET', '/');
// 		$this->data = $response->original->getData();

// 		$this->assertType('articles', 'Illuminate\Database\Eloquent\Collection');
// 		$this->assertType('recents', 'array');
// 		$this->assertType('producers', 'Illuminate\Database\Eloquent\Collection');
// 		$this->assertType('subcats', 'Subcat');
// 		$this->assertType('env', 'string');
// 	}

// 	public function testItems() 
// 	{
// 		$response = $this->action('GET', 'MainController@items', ['category'=>'1', 'subcat'=>'1', 'subcat_id'=>'1']);
// 		$this->data = $response->original->getData();

// 		$this->assertType('items', 'Illuminate\Pagination\Paginator');
// 		$this->assertType('current', 'Subcat');
// 		$this->assertType('articles', 'Illuminate\Database\Eloquent\Collection');
// 		$this->assertType('recents', 'array');
// 		$this->assertType('producers', 'Illuminate\Database\Eloquent\Collection');
// 		$this->assertType('env', 'string');
// 	}

// 	public function testAdmin() {
// 		$response = $this->call('GET', '/admin');
// 		$this->data = $response->original->getData();
// 	}	
// }
