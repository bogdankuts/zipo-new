<?php

class Article extends BaseModel {
	protected $guarded = [];
	public $timestamps = false;
	public $primaryKey = 'article_id';
	public $trimmed = ['title'];
// /*------------------------------------------------
// | READ
// ------------------------------------------------*/
	public static function readAllArticles() {
		$articles = Article::orderBy('weight', 'DESC');
		$articles = $articles->get();
		return $articles;
	}
}