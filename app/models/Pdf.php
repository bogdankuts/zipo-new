<?php

class Pdf extends BaseModel {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'pdf_id';
	public $trimmed = ['good'];

	public static function boot() {
        parent::boot();

		Pdf::deleted(function($pdf) {
			$filepath = HELP::$PDF_IMPORT_DIR.DIRECTORY_SEPARATOR.$pdf->file;

			File::delete($filepath);
			$pdf->items()->detach();
		});
		
		// $work = Pdf::has('subcat')->lists('subcat_id');
		// $all = Pdf::lists('subcat_id');
		// $ids = array_diff($all, $work);
		// $ids = array_keys($ids);
		// $pdfs = Pdf::whereIn('subcat_id', $ids)->get()
		// foreach ($pdfs as $pdf) {
		// 	$pdf->fill(['subcat_id' => '0'])->save();
		// }
    }

	public function producer() {
		return $this->hasOne('Producer', 'producer_id', 'producer_id');
	}

	public function subcat() {
		return $this->hasOne('Subcat', 'subcat_id', 'subcat_id');
	}

	public function items() {
        return $this->belongsToMany('Item'); // optional second argument is pivot table name
    }

/*----------------------------------------------*/
	public static function allPdfByCat() {
		$producer_id = Input::get('producer_id');
		$subcat_id = Input::get('subcat_id');

		return Pdf::where('producer_id', $producer_id)->where('subcat_id', $subcat_id)->orderBy('good')->get();
	}	

    public static function allPdfByProd() {
    	$producer_id = Input::get('producer_id');
    	$category = Input::get('category');

    	$pdfs = Pdf::with(['producer', 'subcat'])->where('producer_id', $producer_id)->orderBy('good')->get()->flate();

    	$items = $pdfs->filter(function($pdf) use ($category) {
    		if ($pdf->category == $category) {
    			return $pdf;
    		}
    	});

    	return $items;
    }

	public static function deleteProducerFromPdfs($producer_id) {
		Pdf::where('producer_id', $producer_id)->update(['producer_id' => 0]);
	}

	// public function setGoodAttribute($value) {
	// 	$this->attributes['good'] = trim($value);
	// }

	// Item::find(600)->pdfs()->attach(1)
	// Pdf::find(1)->items()->attach(2)
	// Pdf::create(['pdf_id'=>2, 'file'=>'222', 'good'=>'222', 'producer_id'=>1])
}