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

	public static function noTitleArticles() {
		$articles = Article::where('meta_title', '');
		$articles = $articles->orderBy('weight', 'DESC');
		$articles = $articles->get();
		return $articles;
	}

	public static function noDescriptionArticles() {
		$articles = Article::where('meta_description', '');
		$articles = $articles->orderBy('weight', 'DESC');
		$articles = $articles->get();
		return $articles;
	}
}