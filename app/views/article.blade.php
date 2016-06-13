@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')

@section('meta')
	@if($article->meta_title !== '')
		<title>Зип Общепит - {{ $article->meta_title }}</title>
	@else
		<title>Зип Общепит - {{ $article->title }}</title>
	@endif
	<meta name='keywords' content='{{ $article->title }} - Зип Общепит'>
	@if($article->meta_description !== '')
		<meta name='description' content='{{ $article->meta_description }}  - Зип Общепит'>
	@else
		<meta name='description' content='{{ $article->title }}  - Зип Общепит'>
	@endif
@stop

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Главная</a></li>
		  <li><a href="/articles">Новости</a></li>
		  <li class="active">{{ $article->title }}</li>
		</ol>
		{{ HTML::image("img/photos/$article->photo", "$article->title", ['class'=>'article_minimg']) }}
		<p class="article_heading">{{ $article->title }}</p>
		<p class="article_date">{{ $HELP::formatDate($article->time) }}</p>
		<hr class="main_hr main_hr_art">
		<div class="article_text"> {{ $article->body }} </div>
		<a href="/articles" class="all_news">Перейти ко всем новостям >></a>
	</div>	
@stop