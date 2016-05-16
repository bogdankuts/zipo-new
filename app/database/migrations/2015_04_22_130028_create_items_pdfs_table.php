<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsPdfsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('item_pdf', function(Blueprint $table)
	    {
	    	$table->increments('item_pdf_id');

	    	// <table_name>_<foreign_table_name>_<column_name>_foreign
	    	$table->integer('item_id')->unsigned()->index();
	    	// $table->dropForeign('pdfs_items_item_id_foreign');
	    	$table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');

	    	// <table_name>_<foreign_table_name>_<column_name>_foreign
	    	$table->integer('pdf_id')->unsigned()->index();
	    	// $table->dropForeign('items_pdfs_pdf_id_foreign');
 			$table->foreign('pdf_id')->references('pdf_id')->on('pdfs')->onDelete('cascade'); 
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('item_pdf');
	}

}
