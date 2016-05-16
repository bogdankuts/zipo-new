@extends('partials/layout')
@extends('partials/header')
@extends('partials/footer')
@extends('partials/left_sidebar')
@extends('partials/right_sidebar')
@include('partials/initial_meta')

@section('body')
	<div class="main_content">
		<ol class="breadcrumb">
		  <li><a href="/">Главная</a></li>
		  <li class="active">Новости</li>
		</ol>
		<h3 class="articles_main_header universal_heading">Новости</h3>
		<hr class="main_hr">
		@foreach ($articles as $article)
			<div class="articles_one">
				<div class="article_preview">
					<div class="article_photo_preview_div">
						{{ HTML::image("img/photos/$article->photo", "$article->title", ['class'=>'articles_minimg']) }}
					</div>
					<h2 class="article_preview_header">{{ $article->title }}</h2>
					<p class="article_one_date">{{ $HELP::formatDate($article->time) }}</p>
					<div class="articles_text">{{ $article->body }}</div>
					<a href='/articles/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}' class="articles_button_read btn btn-default">Читать</a>
					<a href='/{{$HELP::url_slug(["$article->title"])}}?article_id={{$article->article_id}}' class="articles_all_link"></a>
				</div>
			</div>
		<hr>
		@endforeach
	</div>	
@stop