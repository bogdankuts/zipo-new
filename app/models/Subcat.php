<?php

class Subcat extends BaseModel {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'subcat_id';
	protected $trimmed = ['subcat'];
	// UPDATE `subcats` 
	// SET subcat = TRIM(subcat)

	public static function boot() {
        parent::boot();

        Subcat::deleted(function($subcat) {
        	$pdfs = Pdf::where('subcat_id', $subcat->subcat_id)->get();
        	foreach ($pdfs as $pdf) {
        		$pdf->fill(['subcat_id' => '0'])->save();
        	}
        });

		// $work = Pdf::has('subcat')->lists('subcat_id');
		// $all = Pdf::lists('subcat_id');
		// $ids = array_diff($all, $work);
		// $ids = array_values($ids);
		// $ids = array_unique($ids);
		// $pdfs = Pdf::whereIn('subcat_id', $ids)->get()
		// foreach ($pdfs as $pdf) {
		// 	$pdf->fill(['subcat_id' => '0'])->save();
		// }
    }

	public function items() {
		return $this->belongsTo('Item', 'subcat_id', 'subcat_id');
	}

	public function pdf() {
		return $this->belongsTo('Pdf', 'subcat_id', 'subcat_id');
	}

/*------------------------------------------------
| READ
------------------------------------------------*/
	public static function readAllSubcats() {
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

		$subcats = new Subcat;

		foreach ($categories as $category) {
			$subcats[$category] = $subcats->where('category', $category)->groupBy('subcat_id')->orderBy('subcat', 'asc')->get();
		}

		return $subcats;
	}

	public static function getSubcatsByCategory($category_trans) {
		$category_fixed = HELP::$translit[$category_trans];

		return Subcat::where('category', $category_fixed)->orderBy('subcat', 'asc')->get();
	}

	public static function getSubcatsTitlesByCategory() {
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

		$producers_by_category = [];
		
		foreach ($categories as $category) {
			$subcats_titles = Subcat::where('category', $category)->lists('subcat');
			$subcats[$category] = $subcats_titles;
		}

		return $subcats;
	}
}