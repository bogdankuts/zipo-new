<?php

class Recent {
	private static function __recents() {
 		if (Session::has('recents')) {
	 		$recents = (array) Session::get('recents');
 		} else {
	 		$recents = array_fill(1, 4, null);
 			Session::put('recents', $recents);
 		}

 		return $recents;
	}

	public static function readAllRecents() {
		$recents = Recent::__recents();

		/*------------------------------------------------
		| APPLY RECENT FIRST
		------------------------------------------------*/
		$sorted_items = [];
		foreach ($recents as $recent) {
			$items = Item::__items();
			$item = $items->where('item_id', $recent);
			if (!is_null($item->first())) {
				$sorted_items[] = $item->first();
			}
		}
		return $sorted_items;
		/*----------------------------------------------*/
	}

	public static function writeRecentForSession() {
		// CHECK IF $item_id EXISTS:
 		$item_id = Input::get('item_id');
		$items = Item::__items();
		$item = $items->where('item_id', $item_id);
		$item = $item->first();
		if (!isset($item)) {
			return false;
		}

		// IF IT EXISTS THEN:
		$recents = Recent::__recents();

 		if (!in_array($item_id, $recents)) {
	 		Session::put('recents', [
				'1' => $item_id,
				'2' => $recents['1'],
				'3' => $recents['2'],
				'4' => $recents['3']
			]);
 		} else {
 			// CUT SAME item_id and make non-assoc (3)-items array
 			$index = array_search($item_id, $recents);
 			array_splice($recents, $index-1, 1);

 			$recents = [
				'1' => $item_id,
				'2' => $recents[0],
				'3' => $recents[1],
				'4' => $recents[2]
 			];

 			Session::put('recents', $recents);
 			// print_r((array) Session::get('recents'));
 		}
	}
}

// adds '-1' element to left or right side of array to make count() be 5 
// array_pad($input, 5, -1);

// non-associative array with specified range 
// foreach (range(0, 12) as $number) {
//     echo $number;
// }

// fill array 6 times from 5 with 'banana'
// $a = array_fill(5, 6, 'banana');

// array with fixed size
// $array = new SplFixedArray(3);

// exchange array keys with values
// array_flip()

// get only keys or values from assoc array
// array_keys() or array_values()

// LARAVEL HELPERS http://laravel.com/docs/4.2/helpers
// array_fetch()
// array_except()
// array_divide()
// array_dot()
// array_add()
// array_first()
// array_flatten()
// array_forget()
// array_pluck()
// array_pull()
// first() and last()
// e()
// studly_case() and snake_case() camel_case()
// str_limit()
// str_contains()
// str_finish()
// str_plural() and str_singular(0)
// str_random()