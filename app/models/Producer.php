<?php

class Producer extends BaseModel {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'producer_id';
	public $trimmed = ['producer'];

	public function items() {
		return $this->belongsTo('Item', 'producer_id', 'producer_id');
	}

	public function pdf() {
		return $this->belongsTo('Pdf', 'producer_id', 'producer_id');
	}
	


	// public function subcat() {
	// 	return $this->hasManyThrough('Subcat', 'Pdf', 'subcat_id', 'subcat_id');
	// }

	// public function manyThroughMany($related, $through, $firstKey, $secondKey, $pivotKey) {
 //        $model = new $related;
 //        $table = $model->getTable();
 //        $throughModel = new $through;
 //        $pivot = $throughModel->getTable();

 //        return $model
 //            ->join($pivot, $pivot . '.' . $pivotKey, '=', $table . '.' . $secondKey)
 //            ->select($table . '.*')
 //            ->where($pivot . '.' . $firstKey, '=', $this->producer_id);
 //    }

 //    public function subcat() {
 //        return $this->manyThroughMany('Subcat', 'Pdf', 'subcat_id', 'subcat_id', 'subcat_id');
	// }
/*----------------------------------------------*/
	public static function getPdfProducersByCategory() {
		// return $prods_by_cat = Cache::remember('prods_by_cat', 30, function() {
			$categories = [
				'Механическое_en',
				'Тепловое_en',
				'Холодильное_en',
				'Моечное_en',
				'Механическое_ru',
				'Тепловое_ru',
				'Холодильное_ru',
				'Моечное_ru'
			];

		   	foreach ($categories as $category) {
	   			$prods_by_cat[$category] = Producer::whereHas('pdf.subcat', function($q) use ($category) {
	   				$q->where('category', $category);
	   			})->orderBy('producer', 'asc')->get();
	   		}

	   		return $prods_by_cat;
		// });

		// foreach ($categories as $category) {
			// Producer::whereHas('pdf.subcat', function($q) use ($category){
			// 	$q->where('category', $category);
			// });

			// $pdfs = Producer::has('pdf')->with('pdf.subcat')->groupBy('producer')->get()->flate()->flate();
			// $pdfs = Pdf::with('subcat')
				// with(['subcat' => function($query) {$query->groupBy('category');}])
				// ->with('producer')->get()->flate();
			// $prods_by_cat[$category] = $pdfs->filter(function($pdf) use ($category) {
			// 	if ($pdf->category == $category) {
			// 		return new BaseCollection([$pdf->producer, $pdf->producer_id]);
			// 	}
			// });
		// }

		// foreach ($categories as $category) {
		// 	$pdfs = Producer::has('pdf')->with('pdf.subcat')->groupBy('producer')->get()->flate()->flate();
		// 	// $pdfs = Pdf::with('subcat')
		// 		// with(['subcat' => function($query) {$query->groupBy('category');}])
		// 		// ->with('producer')->get()->flate();
		// 	$prods_by_cat[$category] = $pdfs->filter(function($pdf) use ($category) {
		// 		if ($pdf->category == $category) {
		// 			return new BaseCollection([$pdf->producer, $pdf->producer_id]);
		// 		}
		// 	});
		// }

		// Producer::has('pdf')->with('pdf.subcat')->groupBy('producer')->get()->flate();
		// Producer::has('pdf')->with(['pdf.subcat' => function($q) {$q->select('pdf.good');}])->get();
		// // Subcat::has('pdf')->with('pdf')->with('pdf.producer');
	}

	public static function readAllProducers() {
		$producers = Producer::orderBy('producer', 'ASC');
		$producers = $producers->get();
		return $producers;
	}
}